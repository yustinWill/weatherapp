<?php

namespace App\Http\Controllers\MasterAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->backend_user_id != NULL) {
            $edit_data = std_get([
                "select" => ["*"],
                "table_name" => "m_backend_users",
                "where" => [
                    [
                        "field_name" => "backend_user_id",
                        "operator" => "=",
                        "value" => $request->backend_user_id
                    ]
                ],
                "first_row" => true,
            ]);

            if ($edit_data == NULL) {
                abort(404);
            }
            return view('master_admin/edit',[
                'edit_data' => $edit_data
            ]);
        }
        else{
            abort(404);
        }
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(),[
            "backend_user_name" => "required|max:255",
            "backend_user_email" => "required|max:255"
        ]);

        $attributeNames = [
            "backend_user_name" => "Nama Admin",
            "backend_user_email" => "Email"
        ];

        $validate->setAttributeNames($attributeNames);
        if($validate->fails()){
            $errors = $validate->errors();
            return $errors->all();
        }
        return true;
    }

    public function update(Request $request)
    {
        $validation_res = $this->validate_input($request);
        if ($validation_res !== true) {
            return response()->json([
                'message' => $validation_res
            ],400);
        }

        $edit_data = std_get([
            "select" => ["*"],
            "table_name" => "m_backend_users",
            "where" => [
                [
                    "field_name" => "backend_user_email",
                    "operator" => "=",
                    "value" => $request->backend_user_email
                ],
                [
                    "field_name" => "backend_user_id",
                    "operator" => "!=",
                    "value" => $request->backend_user_id
                ],
            ],
            "first_row" => true,
        ]);

        if ($edit_data != NULL) {
            return response()->json([
                'message' => "Email sudah terdaftar"
            ], 500);
        }

        $update_data = [
            "backend_user_name" => $request->backend_user_name,
            "backend_user_email" => $request->backend_user_email,
            "backend_user_changed_by" => session("user_code"),
            "backend_user_changed_by_name" => session("user_name"),
            "backend_user_changed_time" => date("Y-m-d H:i:s")
        ];

        $update_res = std_update([
            "table_name" => "m_backend_users",
            "where" => ["backend_user_id" => $request->backend_user_id],
            "data" => $update_data
        ]);

        if ($update_res === false) {
            return response()->json([
                'message' => "Terjadi kesalahan dalam update data pengguna, silahkan coba beberapa saat lagi"
            ],500);
        }

        return response()->json([
            'message' => "OK"
        ],200);
    }
}
