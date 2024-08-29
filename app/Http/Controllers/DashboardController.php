<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //This method will return the dashboard page for customer
    public function index(){
        return view('dashboard');
    }
}
