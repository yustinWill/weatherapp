<?php

namespace App\Http\Controllers\MasterLocation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddController extends Controller
{
    public function index()
    {
        return view('master_location/add');
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(),[
            "location_name" => "required|max:255",
            "location_lat" => "required|max:10",
            "location_long" => "required|max:10"
        ]);

        $attributeNames = [
            "location_name" => "Nama Lokasi",
            "location_lat" => "Latitude",
            "location_long" => "Longitude",
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
            "table_name" => "m_locations",
            "where" => [
                [
                    "field_name" => "location_name",
                    "operator" => "=",
                    "value" => $request->location_name
                ]
            ],
            "first_row" => true,
        ]);

        if ($edit_data != NULL) {
            return response()->json([
                'message' => "Lokasi sudah terdaftar"
            ], 500);
        }

        $insert_res = std_insert_get_id([
            "table_name" => "m_locations",
            "data" => [
                "location_name" => $request->location_name,
                "location_lat" => $request->location_lat,
                "location_long" => $request->location_long,
                "location_created_by" => session("user_code"),
                "location_created_by_name" => session("user_name"),
                "location_changed_by" => session("user_code"),
                "location_changed_by_name" => session("user_name"),
                "location_created_time" => date("Y-m-d H:i:s"),
                "location_changed_time" => date("Y-m-d H:i:s"),
            ]
        ]);

        if ($insert_res <= 0) {
            return response()->json([
                'message' => "Terjadi kesalahan dalam menyimpan data pengguna, silahkan coba beberapa saat lagi"
            ], 500);
        }

        return response()->json([
            'message' => "OK"
        ], 200);
    }
}
