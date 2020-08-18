<?php

namespace App\Http\Controllers\MasterAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->backend_user_id) {
            $delete_res = std_delete([
                "table_name" => "m_backend_users",
                "where" => [
                    "backend_user_id" => $request->backend_user_id
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
