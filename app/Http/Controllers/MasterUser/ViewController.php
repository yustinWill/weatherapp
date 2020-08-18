<?php

namespace App\Http\Controllers\MasterUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                "field_name" => "user_created_time",
                "operator" => ">=",
                "value" => $filter["start"] . " 00:00:00",
            ],
            [
                "field_name" => "user_created_time",
                "operator" => "<=",
                "value" => $filter["end"] . " 23:59:59",
            ],
        ];

        if ($filter["location"] != 'ALL' && $filter["location"] != null) {
            array_push($where, [
                "field_name" => "user_location_id",
                "operator" => "=",
                "value" => $filter["location"]
            ]);
        }

        $user_data = std_get([
            "select" => ["*"],
            "table_name" => "m_users",
            "where" => $where,
            "order_by" => [
                [
                    "field" => "user_name",
                    "type" => "ASC",
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


        return view('master_user/view', [
            'user_data' => $user_data,
            'location_data' => $location_data,
            'filter' => $filter
        ]);
    }

    public function detail(Request $request)
    {
        if ($request->user_id != NULL) {
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

            return view(
                'master_user/detail',
                [
                    'detail_data' => $detail_data,
                    'location_data' => $location_data
                ]
            );
        }
    }
}
