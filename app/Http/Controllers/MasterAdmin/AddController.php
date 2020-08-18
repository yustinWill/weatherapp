<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddController extends Controller
{
    public function index()
    {
        return view('master_admin/add');
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(), [
            "backend_user_name" => "required|max:255",
            "backend_user_email" => "required|max:255",
            "backend_user_password" => "required|max:255"
        ]);

        $attributeNames = [
            "backend_user_name" => "Nama Admin",
            "backend_user_email" => "Email",
            "backend_user_password" => "Kata Sandi"
        ];

        $validate->setAttributeNames($attributeNames);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors->all();
        }
        return true;
    }

    public function save(Request $request)
    {
        $validation_res = $this->validate_input($request);
        if ($validation_res !== true) {
            return response()->json([
                'message' => $validation_res
            ], 400);
        }

        $edit_data = std_get([
            "select" => ["*"],
            "table_name" => "m_backend_users",
            "where" => [
                [
                    "field_name" => "backend_user_email",
                    "operator" => "=",
                    "value" => $request->backend_user_email
                ]
            ],
            "first_row" => true,
        ]);

        if ($edit_data != NULL) {
            return response()->json([
                'message' => "Email sudah terdaftar"
            ], 500);
        }

        $insert_res = std_insert_get_id([
            "table_name" => "m_backend_users",
            "data" => [
                "backend_user_code" => 'ADMIN-TEMP',
                "backend_user_name" => $request->backend_user_name,
                "backend_user_email" => $request->backend_user_email,
                "backend_user_role" => 1,
                "backend_user_is_active" => 1,
                "backend_user_password" => Hash::make($request->backend_user_password),
                "backend_user_last_login" => null,
                "backend_user_last_login_ip_address" => '',
                "backend_user_created_by" => session("user_code"),
                "backend_user_created_by_name" => session("user_name"),
                "backend_user_changed_by" => session("user_code"),
                "backend_user_changed_by_name" => session("user_name"),
                "backend_user_created_time" => date("Y-m-d H:i:s"),
                "backend_user_changed_time" => date("Y-m-d H:i:s"),
            ]
        ]);

        $update_data = [
            "backend_user_code" => 'ADMIN'.$insert_res
        ];

        $update_res = std_update([
            "table_name" => "m_backend_users",
            "where" => ["backend_user_id" => $insert_res],
            "data" => $update_data
        ]);

        if ($insert_res <= 0 || $update_res === false) {
            return response()->json([
                'message' => "Terjadi kesalahan dalam menyimpan data pengguna, silahkan coba beberapa saat lagi"
            ], 500);
        }

        return response()->json([
            'message' => "OK"
        ], 200);
    }
}
