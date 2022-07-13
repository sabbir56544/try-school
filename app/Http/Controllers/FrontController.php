<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index ()
    {
        $data['title'] = "Gains School | Home";

        return view('welcome', $data);
    }
}
