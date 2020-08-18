<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('authentication.login');
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(), [
            "email" => "required|max:255",
            "password" => "required|max:50"
        ]);

        $attributeNames = [
            "email" => "Alamat Email",
            "password" => "Kata Sandi"
        ];

        $validate->setAttributeNames($attributeNames);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors->all();
        }
        return true;
    }

    public function process(Request $request)
    {
        $validation_res = $this->validate_input($request);
        if ($validation_res !== true) {
            return response()->json([
                'message' => $validation_res
            ], 400);
        }

        $user_data = std_get([
            "select" => [
                "backend_user_code",
                "backend_user_name",
                "backend_user_role",
                "backend_user_email",
                "backend_user_password",
                "backend_user_is_active"
            ],

            "table_name" => "m_backend_users",
            "where" => [
                [
                    "field_name" => "backend_user_email",
                    "operator" => "=",
                    "value" => $request->email,
                ],
            ],
            "first_row" => true
        ]);

        if ($user_data == NULL) {
            return response()->json([
                'message' => "Alamat email atau kata sandi salah!"
            ], 500);
        }

        if ($user_data["backend_user_is_active"] != 1) {
            return response()->json([
                'message' => "Akun Anda tidak aktif!"
            ], 500);
        }

        if (!Hash::check($request->password, $user_data["backend_user_password"])) {
            return response()->json([
                'message' => "Alamat email atau kata sandi salah!"
            ], 500);
        }

        $words = explode(" ", $user_data["backend_user_name"]);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        session(['user_code' => $user_data["backend_user_code"]]);
        session(['user_initial_name' => $acronym]);
        session(['user_name' => $user_data["backend_user_name"]]);
        session(['user_role' => $user_data["backend_user_role"]]);
        session(['user_email' => $user_data["backend_user_email"]]);

        $update_res = std_update([
            "table_name" => "m_backend_users",
            "where" => ["backend_user_email" => $request->email],
            "data" => [
                "backend_user_last_login" => date("Y-m-d H:i:s"),
                "backend_user_last_login_ip_address" => $request->ip()
            ]
        ]);

        if ($update_res == 0) {
            return response()->json([
                'message' => "Terjadi kesalahan dalam melakukan proses login, silahkan coba beberapa saat lagi"
            ], 500);
        }

        return response()->json([
            'message' => "OK"
        ], 200);
    }
}
