<?php

namespace App\Http\Controllers\MasterUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user_id != NULL) {
            $edit_data = std_get([
                "select" => ["*"],
                "table_name" => "m_users",
                "where" => [
                    [
                        "field_name" => "user_id",
                        "operator" => "=",
                        "value" => $request->user_id
                    ]
                ],
                "first_row" => true,
            ]);

            $location_data = std_get([
                "select" => ["*"],
                "table_name" => "m_locations",
                "order_by" => [
                    [
                        "field" => "location_name",
                        "type" => "ASC",
                    ]
                ],
                "multiple_rows" => true,
            ]);

            if ($edit_data == NULL) {
                abort(404);
            }
            return view('master_user/edit',
            [
                'edit_data' => $edit_data,
                'location_data' => $location_data
            ]);
        }
        else{
            abort(404);
        }
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(),[
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
            "table_name" => "m_users",
            "where" => [
                [
                    "field_name" => "user_email",
                    "operator" => "=",
                    "value" => $request->user_email
                ],
                [
                    "field_name" => "user_id",
                    "operator" => "!=",
                    "value" => $request->user_id
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
            "user_name" => $request->user_name,
            "user_email" => $request->user_email,
            "user_location_id" => $request->user_location_id,
            "user_changed_by" => session("user_code"),
            "user_changed_by_name" => session("user_name"),
            "user_changed_time" => date("Y-m-d H:i:s")
        ];

        $update_res = std_update([
            "table_name" => "m_users",
            "where" => ["user_id" => $request->user_id],
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
