<?php

namespace App\Http\Controllers\Authentication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget(['user_code', 'user_name','user_role','user_email']);
        return redirect('/');
    }
}