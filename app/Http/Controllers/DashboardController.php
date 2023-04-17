<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pages' => 'Dashboard',
            'breadcrumbs' => Auth::user()->profile->setting->language == 1 ? 'Dashboard' : 'Beranda',
            'countUser' => User::where('role', '=', 0)->count(),
            'users' => User::where('role', '=', 0)->simplePaginate()
        ];
        return view('admin.dashboard', $data);
    }
}
