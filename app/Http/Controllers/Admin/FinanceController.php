<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
error_reporting(0);
class FinanceController extends Controller
{
    public function index()
    {
        return view('dashboard.finance.finance');
    }

    public function payment_summery()
    {
        return view('dashboard.finance.payment_summery');
    }

    public function balance_with_users()
    {
        return view('dashboard.finance.balance_with_users');
    }

    public function credit_limit()
    {
        return view('dashboard.finance.credit_limit');
    }

    
}
