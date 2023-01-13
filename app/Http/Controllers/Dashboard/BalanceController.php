<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Balance;
use Illuminate\Http\Request;
error_reporting(0);
class BalanceController extends Controller
{
    public function index()
    {
        $user_balances = Balance::paginate(10);
        $data['user_balances'] = $user_balances;
        return view('dashboard.finance.balance_with_users')->with($data);
    }
    
    public function credit_limit()
    {
        $credit_balances = Balance::paginate(10);
        $data['credit_balances'] = $credit_balances;
        return view('dashboard.finance.credit_limit')->with($data);
    }
    
    public function payment_summery()
    {
        $paymentSummaries=Balance::all();   
        return view('dashboard.payment-summery.payment_summery',get_defined_vars());
    }
}
