<?php

namespace App\Http\Controllers;

class homepageController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }
}