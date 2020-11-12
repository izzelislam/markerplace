<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransaction=TransactionDetail::with(['transaction.user','product.galleries'])
                     ->whereHas('product',function($product){
                         $product->where('user_id',Auth::user()->id);
                     })->get();
        
        $buyTransaction=TransactionDetail::with(['transaction.user','product.galleries'])
                     ->whereHas('transaction',function($transaction){
                         $transaction->where('user_id',Auth::user()->id);
                     })->get();

        return view('pages.owner.dashboard-transaction',compact('sellTransaction','buyTransaction'));
    }

    public function detail(Request $request , $id)
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])->findOrfail($id);

        return view('pages.owner.dashboard-transaction-detail',compact('transaction'));
    }

    public function update(Request $request,$id)
    {
        $data =$request->all();

        $item=TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect(route('dashboard-transaction-detail',$id));
    }
}
