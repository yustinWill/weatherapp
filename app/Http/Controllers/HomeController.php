<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $total_user = std_get([
            "select" => ["*"],
            "table_name" => "m_users",
            "count" => true,
            "first_row" => true
        ]);
      
        $total_weather_log = std_get([
            "select" => ["*"],
            "table_name" => "t_weather_logs",
            "count" => true,
            "first_row" => true
        ]);

        $total_location = std_get([
            "select" => ["*"],
            "table_name" => "m_locations",
            "count" => true,
            "first_row" => true
        ]);

        return view('dashboard', [
            'total_user' => $total_user,
            'total_weather_log' => $total_weather_log,
            'total_location' => $total_location
        ]);
    }
}
