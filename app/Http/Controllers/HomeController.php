<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function staffHome()
    {
        return view('staff.staffHome');
    }

    public function memberHome()
    {
        return view('customer.customerHome');
    }

    public function adminHome()
    {
        return view('admin.adminHome');
    }
}
