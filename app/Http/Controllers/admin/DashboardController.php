<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //This method will return the dashboard admin view
    public function index()
    {
        return view('admin.dashboard');
    }
}
