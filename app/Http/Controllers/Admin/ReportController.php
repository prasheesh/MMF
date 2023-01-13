<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
error_reporting(0);
class ReportController extends Controller
{
    public function reports()
    {
        return view('dashboard.report.reports');
    }
}
