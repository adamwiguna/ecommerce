<?php

namespace App\Http\Controllers\BackOffice\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('back-office.super-admin.dashboard');
    }
}
