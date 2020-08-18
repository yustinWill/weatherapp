<?php

namespace App\Http\Controllers\MasterLocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ViewController extends Controller
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

        return view('master_location/view', [
            'location_data' => $location_data
        ]);
    }

    public function detail(Request $request)
    {
        if ($request->location_id != NULL) {
            $detail_data = std_get([
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

            return view('master_location/detail', [
                'detail_data' => $detail_data
            ]);
        }
    }
}
