<?php

namespace App\Http\Controllers\satici;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('satici');
    }

    public function index()
    {
        return view("satici.home");
    }
}
