<?php

namespace App\Http\Controllers\WeatherConfig;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddController extends Controller
{
    public function index()
    {
        return view('weather_config/add');
    }

    public function validate_input($request)
    {
        $validate = Validator::make($request->all(), [
            "weather_config_weather_key" => "required|max:255",
            "weather_config_weather_account" => "required|max:255",
            "weather_config_weather_password" => "required|max:255"
        ]);

        $attributeNames = [
            "weather_config_weather_key" => "API Key",
            "weather_config_weather_account" => "Akun",
            "weather_config_weather_password" => "Kata Sandi"
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

        $insert_res = std_insert_get_id([
            "table_name" => "m_weather_configs",
            "data" => [
                "weather_config_weather_key" => $request->weather_config_weather_key,
                "weather_config_weather_account" => $request->weather_config_weather_account,
                "weather_config_weather_password" => $request->weather_config_weather_password,
                "weather_config_user_created_by" => session("user_code"),
                "weather_config_user_created_by_name" => session("user_name"),
                "weather_config_user_changed_by" => session("user_code"),
                "weather_config_user_changed_by_name" => session("user_name"),
                "weather_config_user_created_time" => date("Y-m-d H:i:s"),
                "weather_config_user_changed_time" => date("Y-m-d H:i:s"),
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
