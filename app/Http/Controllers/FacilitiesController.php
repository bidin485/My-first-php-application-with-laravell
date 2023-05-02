<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index() {
        return view('pages.facilities.index');
    }
    public function create() {
        return view('pages.facilities.create');
    }
    public function show() {
        return view('pages.facilities.show');
    }
}
