<?php

namespace App\Http\Controllers;

use App\Helpers\InfoMenuHelper;
use App\Repositorio\HomeRepositori;


class HomeController extends Controller{

    public function index()
    {
        $info = InfoMenuHelper::InfoConnection();

        $counts = HomeRepositori::getCountDashboardsGraphics();

        return view('home.home',compact('counts','info'));
    }



}
