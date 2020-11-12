<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Model\TransactionDetail;
use App\User;


class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('user_id', Auth::user()->id);
                            });
        

        $revenue = $transactions->get()->reduce(function ($carry, $item) {
            return $carry + $item->price_id;
        });

        $customer =User::count();

        return view('pages.owner.dashboard',[
            'transaction_count'=>$transactions->count(),
            'transaction_data'=>$transactions->get(),
            'revenue'=>$revenue,
            'customer'=>$customer,

        ]);
    }
}
