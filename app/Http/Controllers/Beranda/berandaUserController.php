<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class berandaUserController extends Controller
{
    //

        public function index()
        {
            return view('content-app.content-beranda');
        }
}
