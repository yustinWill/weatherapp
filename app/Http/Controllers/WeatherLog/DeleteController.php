<?php

namespace App\Http\Controllers\WeatherLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function index(Request $request)
    {        
        if ($request->weather_log_id) {
            $delete_res = std_delete([
                "table_name" => "t_weather_logs",
                "where" => [
                    "weather_log_id" => $request->weather_log_id
                ]
            ]);

            if ($delete_res === false) {
                return response()->json([
                    'message' => "Terjadi kesalahan dalam menghapus data pengguna"
                ],500);
            }

            return response()->json([
                'message' => "Data pengguna berhasil dihapus"
            ],200);
        }

        return response()->json([
            'message' => "Terjadi kesalahan dalam menghapus data pengguna"
        ],500);
    }
}
