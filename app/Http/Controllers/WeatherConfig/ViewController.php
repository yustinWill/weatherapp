<?php

namespace App\Http\Controllers\WeatherConfig;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        $config_data = std_get([
            "select" => ["*"],
            "table_name" => "m_weather_configs",
            "first_row" => true,
        ]);

        return view('weather_config/view', [
            'config_data' => $config_data
        ]);
    }

    public function detail(Request $request)
    {
        if ($request->backend_user_id != NULL) {
            $detail_data = std_get([
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

            return view(
                'weather_config/detail',
                [
                    'detail_data' => $detail_data
                ]
            );
        }
    }
}
