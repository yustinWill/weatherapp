<?php

namespace App\Http\Controllers\WeatherLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->location == null) {
            $filter["start"] = date("Y-m-01");
            $filter["end"] = date("Y-m-d");
            $filter["location"] = null;
        } else {
            $filter["start"] = $request->start;
            $filter["end"] = $request->end;
            $filter["location"] = $request->location;
        }

        $where = [
            [
                "field_name" => "weather_log_created_time",
                "operator" => ">=",
                "value" => $filter["start"] . " 00:00:00",
            ],
            [
                "field_name" => "weather_log_created_time",
                "operator" => "<=",
                "value" => $filter["end"] . " 23:59:59",
            ],
        ];

        if ($filter["location"] != 'ALL' && $filter["location"] != null) {
            array_push($where, [
                "field_name" => "weather_log_location_id",
                "operator" => "=",
                "value" => $filter["location"],
            ]);
        }

        $weather_log_data = std_get([
            "select" => ["*"],
            "table_name" => "t_weather_logs",
            "where" => $where,
            "order_by" => [
                [
                    "field" => "weather_log_id",
                    "type" => "DESC",
                ]
            ],
            "multiple_rows" => true,
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


        return view('weather_log/view', [
            'weather_log_data' => $weather_log_data,
            'location_data' => $location_data,
            'filter' => $filter
        ]);
    }

    public function detail(Request $request)
    {
        if ($request->weather_log_id != NULL) {
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

            $detail_data = std_get([
                "select" => ["*"],
                "table_name" => "t_weather_logs",
                "where" => [
                    [
                        "field_name" => "weather_log_id",
                        "operator" => "=",
                        "value" => $request->weather_log_id
                    ]
                ],
                "first_row" => true,
            ]);

            $decoded_detail_current = json_decode($detail_data["weather_log_current"], true);
            $decoded_detail_daily = json_decode($detail_data["weather_log_next_week"], true);

            $date_current = $decoded_detail_current["date"];
            $weather_current = $decoded_detail_current["weather_today_code"];
            $temparature_current = $decoded_detail_current["temp"];
            $heavy_rain_current = $decoded_detail_current["is_heavy_rain_current"];
            
            $daily_data = [];

            return view('weather_log/detail', [
                'detail_data' => $detail_data,
                'location_data' => $location_data,
                'date_current' => $date_current,
                'temparature_current' => $temparature_current,
                'heavy_rain_current' => $heavy_rain_current,
                'daily_data' => $decoded_detail_daily
            ]);
        }
    }

    public function generate_full_log(Request $request)
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

        foreach ($location_data as $loc_data) {
            $user_data = std_get([
                "select" => ["*"],
                "table_name" => "m_users",
                "where" => [
                    [
                        "field_name" => "user_location_id",
                        "operator" => "=",
                        "value" => $loc_data["location_id"]
                    ]
                ],
                "multiple_rows" => true
            ]);

            $current_log_data = std_get([
                "select" => ["*"],
                "table_name" => "t_weather_logs",
                "where" => [
                    [
                        "field_name" => "weather_log_location_id",
                        "operator" => "=",
                        "value" => $loc_data["location_id"]
                    ]
                ],
                "order_by" => [
                    [
                        "field" => "weather_log_id",
                        "type" => "DESC",
                    ]
                ],
                "first_row" => true,
            ]);

            $weather_log_code = "LOG-" . $loc_data["location_id"] . "-1";
    
            if ($current_log_data != NULL) {
                $log_code_piece = explode("-", $current_log_data["weather_log_code"]);
                $log_code_new =  (int)$log_code_piece[2] + 1;
                $weather_log_code = "LOG-" . $loc_data["location_id"] . "-" . $log_code_new;
            }

            $weather_lat = $loc_data["location_lat"];
            $weather_long = $loc_data["location_long"];
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

            $weather_result_data = $weather_result["data"];
            $weather_current = $weather_result_data["current"]["weather"][0]["id"];

            $is_heavy_rain_current = false;
        
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
                if($weather_current != 500) $is_heavy_rain_current = true;
            }
            elseif ($weather_current >= 300) {
                // Drizzle
                if($weather_current != 300) $is_heavy_rain_current = true;
            }
            else {
                // Thunderstorm
                $is_heavy_rain_current = true;
            }

            $daily_data = [];
        
            foreach ($weather_result_data["daily"] as $item) {
                $weather_current_daily = $item["weather"][0]["id"];
                $is_heavy_rain = false;
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
                    if($weather_current_daily != 500) $is_heavy_rain = true;
                }
                elseif ($weather_current_daily >= 300) {
                    // Drizzle
                    if($weather_current_daily != 300) $is_heavy_rain = true;
                }
                else {
                    // Thunderstorm
                    $is_heavy_rain = true;
                }
    
                array_push($daily_data, [
                    "date" => date("Y-m-d",$item["dt"] + $weather_result_data["timezone_offset"]),
                    "weather_today_code" => $weather_current_daily,
                    "is_heavy_rain" => $is_heavy_rain,
                    "temp_min" => $item["temp"]["min"],
                    "temp_max" => $item["temp"]["max"]
                ]);
            }

            $encoded_detail_current = json_encode([
                "date" => date("Y-m-d H:m:s",$weather_result_data["current"]["dt"] + $weather_result_data["timezone_offset"]),
                "weather_today_code" => $weather_current,
                "is_heavy_rain_current" => $is_heavy_rain_current,
                "temp" => $weather_result_data["current"]["temp"]
            ]);
            $encoded_detail_daily = json_encode($daily_data);
            
            $insert_res = std_insert_get_id([
                "table_name" => "t_weather_logs",
                "data" => [
                    "weather_log_code" => $weather_log_code,
                    "weather_log_location_id" => (int)$loc_data["location_id"],
                    "weather_log_current" => $encoded_detail_current,
                    "weather_log_next_week" => $encoded_detail_daily,
                    "weather_log_created_by" => session("user_code"),
                    "weather_log_created_by_name" => session("user_name"),
                    "weather_log_changed_by" => session("user_code"),
                    "weather_log_changed_by_name" => session("user_name"),
                    "weather_log_created_time" => date("Y-m-d H:i:s"),
                    "weather_log_changed_time" => date("Y-m-d H:i:s"),
                ]
            ]);

            $heavy_rain_tommorow = $daily_data[1]["is_heavy_rain"];

            // if($heavy_rain_tommorow){
                foreach ($user_data as $usr_data) {
                    // BEGIN::SEND EMAIL FOR WEATHER NOTIFICATION
                        //LARAVEL send mail sample
                        $to_name = $usr_data["user_name"];
                        $to_email = $usr_data["user_email"];
                        $data = array(
                            "name"=> $usr_data["user_name"],
                            "location_name"=> $loc_data["location_name"],
                        );
                        Mail::send("notification_email.sendmail", $data, function($message) use ($to_name, $to_email, $loc_data) {
                            $message
                            ->to($to_email, $to_name)
                            ->subject("Tommorow will be heavy rain at " . $loc_data["location_name"]);
                            $message->from("vovoba1041@acceptmail.net", "Rain Notification");
                        });
                    // END::SEND EMAIL FOR WEATHER NOTIFICATION
                }
            // }

        }

        return response()->json([
            'message' => "OK"
        ], 200);
    }
}
