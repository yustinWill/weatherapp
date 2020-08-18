<?php

namespace App\Http\Controllers\MasterLocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->location_id != NULL) {
            $edit_data = std_get([
                "select" => ["*"],
                "table_name" => "m_locations",
                "where" => [
                    [
                        "field_name" => "location_id",
                        "operator" => "=",
                        "value" => $request->location_id
                    ]
                ],
                "first_row" => true,
            ]);

            if ($edit_data == NULL) {
                abort(404);
            }
            return view('master_location/edit',[
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
            "location_name" => "required|max:255",
            "location_lat" => "required|max:10",
            "location_long" => "required|max:10",
            "location_is_active" => "required|max:10"
        ]);

        $attributeNames = [
            "location_name" => "Nama Lokasi",
            "location_lat" => "Latitude",
            "location_long" => "Longitude",
            "location_is_active" => "Status"
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
            "table_name" => "m_locations",
            "where" => [
                [
                    "field_name" => "location_name",
                    "operator" => "=",
                    "value" => $request->location_name
                ],
                [
                    "field_name" => "location_id",
                    "operator" => "!=",
                    "value" => $request->location_id
                ],
            ],
            "first_row" => true,
        ]);

        if ($edit_data != NULL) {
            return response()->json([
                'message' => "Lokasi sudah terdaftar"
            ], 500);
        }

        $update_data = [
            "location_name" => $request->location_name,
            "location_lat" => $request->location_lat,
            "location_long" => $request->location_long,
            "location_is_active" => $request->location_is_active,
            "location_changed_by" => session("user_code"),
            "location_changed_by_name" => session("user_name"),
            "location_changed_time" => date("Y-m-d H:i:s")
        ];

        $update_res = std_update([
            "table_name" => "m_locations",
            "where" => ["location_id" => $request->location_id],
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
