<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $customer= User::count();
        $transaction=Transaction::count();
        $reveneu=Transaction::sum('total');

        return view('pages.admin.dashboard',compact('customer','transaction','reveneu'));
    }
}
