<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->start == null && $request->end == null) {
            $filter["start"] = date("Y-m-01");
            $filter["end"] = date("Y-m-d");
        } else {
            $filter["start"] = $request->start;
            $filter["end"] = $request->end;
        }

        $where = [
            [
                "field_name" => "backend_user_created_time",
                "operator" => ">=",
                "value" => $filter["start"] . " 00:00:00",
            ],
            [
                "field_name" => "backend_user_created_time",
                "operator" => "<=",
                "value" => $filter["end"] . " 23:59:59",
            ],
        ];


        $user_data = std_get([
            "select" => ["*"],
            "table_name" => "m_backend_users",
            "where" => $where,
            "order_by" => [
                [
                    "field" => "backend_user_name",
                    "type" => "ASC",
                ]
            ],
            "multiple_rows" => true,
        ]);

        return view('master_admin/view', [
            'user_data' => $user_data,
            'filter' => $filter
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
                'master_admin/detail',
                [
                    'detail_data' => $detail_data
                ]
            );
        }
    }
}
