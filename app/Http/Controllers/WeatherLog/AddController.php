<?php

namespace App\Http\Controllers\WeatherLog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddController extends Controller
{
    public function index(Request $request)
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
            "multiple_rows" => true,
        ]);

        if ($request->weather_log_location_id != null) {
            $location_detail = std_get([
                "select" => ["*"],
                "table_name" => "m_locations",
                "where" => [
                    [
                        "field_name" => "location_id",
                        "operator" => "=",
                        "value" => $request->weather_log_location_id
                    ]
                ],
                "first_row" => true,
            ]);
            
    
            if ($location_detail == NULL) {
                return response()->json([
                    'message' => "Terjadi kesalahan dalam mendapatkan data lokasi, silahkan coba beberapa saat lagi"
                ], 500);
            }
    
            $current_log_data = std_get([
                "select" => ["*"],
                "table_name" => "t_weather_logs",
                "where" => [
                    [
                        "field_name" => "weather_log_location_id",
                        "operator" => "=",
                        "value" => $request->weather_log_location_id
                    ]
                ],
                "first_row" => true,
            ]);
    
            $weather_config = std_get([
                "select" => ["weather_config_weather_key"],
                "table_name" => "m_weather_configs",
                "order_by" => [
                    [
                        "field" => "weather_config_id",
                        "type" => "DESC",
                    ]
                ],
                "first_row" => true,
            ]);
    
            $weather_log_code = "LOG-" . $request->weather_log_location_id . "-1";
    
            if ($current_log_data != NULL) {
                $log_code_piece = explode("-", $current_log_data["weather_log_code"]);
                $log_code_new =  (int)$log_code_piece[2] + 1;
                $weather_log_code = "LOG-" . $request->weather_log_location_id . "-" . $log_code_new;
            }
    
            $weather_lat = $location_detail["location_lat"];
            $weather_long = $location_detail["location_long"];
            $weather_units = "metric";
            $weather_api_key = $weather_config["weather_config_weather_key"];
    
            $weather_link = "https://api.openweathermap.org/data/2.5/onecall";
            $weather_data = [
                'lat' => $weather_lat,
                'lon' => $weather_long,
                'units' => $weather_units,
                'appid' => $weather_api_key
            ];
    
            $weather_result = curl_get($weather_link, $weather_data);
    
            if($weather_result["status_code"] == 200){
                $weather_result_data = $weather_result["data"];
        
                $encoded_detail_current = json_encode($weather_result_data["current"]);
                $encoded_detail_daily = json_encode($weather_result_data["daily"]);
                $decoded_detail_current = $weather_result_data["current"];
                $decoded_detail_daily = $weather_result_data["daily"];
        
                $date_current = date("Y-m-d H:i:s",$decoded_detail_current["dt"] + $weather_result_data["timezone_offset"]);
                $weather_current = $decoded_detail_current["weather"][0]["id"];
                $temparature_current = $decoded_detail_current["temp"];
                $heavy_rain_current = false;
        
                if ($weather_current > 800) {
                    // Cloudy
                }
                elseif ($weather_current == 800) {
                    // Clear
                }
                elseif ($weather_current >= 700) {
                    // Atmosphere
                }
                elseif ($weather_current >= 500) {
                    // Rain
                    if($weather_current != 500) $heavy_rain_current = true;
                }
                elseif ($weather_current >= 300) {
                    // Drizzle
                    if($weather_current != 300) $heavy_rain_current = true;
                }
                else {
                    // Thunderstorm
                    $heavy_rain_current = true;
                }
                
                $daily_data = [];
        
                foreach ($decoded_detail_daily as $item) {
                    $weather_current_daily = $item["weather"][0]["id"];
                    $heavy_rain_daily = false;
                    if ($weather_current_daily > 800) {
                        // Cloudy
                    }
                    elseif ($weather_current_daily == 800) {
                        // Clear
                    }
                    elseif ($weather_current_daily >= 700) {
                        // Atmosphere
                    }
                    elseif ($weather_current_daily >= 500) {
                        // Rain
                        if($weather_current_daily != 500) $heavy_rain_daily = true;
                    }
                    elseif ($weather_current_daily >= 300) {
                        // Drizzle
                        if($weather_current_daily != 300) $heavy_rain_daily = true;
                    }
                    else {
                        // Thunderstorm
                        $heavy_rain_daily = true;
                    }
        
                    array_push($daily_data, [
                        "date" => date("Y-m-d",$item["dt"] + $weather_result_data["timezone_offset"]),
                        "heavy_rain_daily" => $heavy_rain_daily
                    ]);
                }
                
                return view('weather_log/add', [
                    'location_data' => $location_data,
                    'weather_log_location_id' => $request->weather_log_location_id,
                    'weather_log_code' => $weather_log_code,
                    'encoded_detail_current' => $encoded_detail_current,
                    'encoded_detail_daily' => $encoded_detail_daily,
                    'date_current' => $date_current,
                    'temparature_current' => $temparature_current,
                    'heavy_rain_current' => $heavy_rain_current,
                    'daily_data' => $daily_data
                ]);
            }
        }

        return view('weather_log/add', [
            'location_data' => $location_data,
            'weather_log_location_id' => null,
            'weather_log_code' => null,
            'encoded_detail_current' => null,
            'encoded_detail_daily' => null,
            'date_current' => null,
            'temparature_current' => null,
            'heavy_rain_current' => null,
            'daily_data' => null
        ]);
    }

    public function save(Request $request)
    {   
        $insert_res = std_insert_get_id([
            "table_name" => "t_weather_logs",
            "data" => [
                "weather_log_code" => $request->weather_log_code,
                "weather_log_location_id" => (int)$request->weather_log_location_id,
                "weather_log_current" => $request->encoded_detail_current,
                "weather_log_next_week" => $request->encoded_detail_daily,
                "weather_log_created_by" => session("user_code"),
                "weather_log_created_by_name" => session("user_name"),
                "weather_log_changed_by" => session("user_code"),
                "weather_log_changed_by_name" => session("user_name"),
                "weather_log_created_time" => date("Y-m-d H:i:s"),
                "weather_log_changed_time" => date("Y-m-d H:i:s"),
            ]
        ]);

        if ($insert_res <= 0) {
            return response()->json([
                'message' => "Terjadi kesalahan dalam menyimpan data cuaca, silahkan coba beberapa saat lagi"
            ], 500);
        }

        return response()->json([
            'message' => "OK"
        ], 200);
    }
}
