<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index() {
        return view('pages.expenses.index');
    }
    public function create() {
        return view('pages.expenses.create');
    }
    public function show() {
        return view('pages.expenses.show');
    }
}
