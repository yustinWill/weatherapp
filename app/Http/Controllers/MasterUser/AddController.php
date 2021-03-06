<?php

namespace App\Http\Controllers\MasterUser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddController extends Controller
{
    public function index()
    {
        $location_data = std_get([
            "select" => ["*"],
            "table_name" => "m_locations",
            "order_by" => [
                [
                    "field" => "location_name",
                    "type" => "ASC",
                ]
            ],
            "where" => [
                [
                    "field_name" => "location_is_active",
                    "operator" => "=",
                    "value" => 1
                ]
            ],
            "multiple_rows" => true,
        ]);
        return view('master_user/add', [
            'location_data' => $location_data
        ]);
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(), [
            "user_name" => "required|max:255",
            "user_email" => "required|max:255",
            "user_location_id" => "required|max:10"
        ]);

        $attributeNames = [
            "user_name" => "Nama User",
            "user_email" => "Email",
            "user_location_id" => "Lokasi"
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
            "table_name" => "m_users",
            "where" => [
                [
                    "field_name" => "user_email",
                    "operator" => "=",
                    "value" => $request->user_email
                ]
            ],
            "first_row" => true,
        ]);

        if ($edit_data != NULL) {
            return response()->json([
                'message' => "Email sudah terdaftar"
            ], 500);
        }

        $user_data = std_get([
            "select" => ["*"],
            "table_name" => "m_users",
            "multiple_rows" => true,
        ]);

        $insert_res = std_insert_get_id([
            "table_name" => "m_users",
            "data" => [
                "user_code" => 'USER'.count($user_data),
                "user_name" => $request->user_name,
                "user_email" => $request->user_email,
                "user_role" => 1,
                "user_is_active" => 1,
                "user_registration_timestamp" => date("Y-m-d H:i:s"),
                "user_location_id" => (int)$request->user_location_id,
                "user_last_login" => null,
                "user_last_login_ip_address" => '',
                "user_created_by" => session("user_code"),
                "user_created_by_name" => session("user_name"),
                "user_changed_by" => session("user_code"),
                "user_changed_by_name" => session("user_name"),
                "user_created_time" => date("Y-m-d H:i:s"),
                "user_changed_time" => date("Y-m-d H:i:s"),
            ]
        ]);

        $update_data = [
            "user_code" => 'USER'.$insert_res
        ];

        $update_res = std_update([
            "table_name" => "m_users",
            "where" => ["user_id" => $insert_res],
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
