<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Cart;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    
    public function index(Request $request , $id)
    {
        $product = Product::with(['galleries','user'])->where('slug', $id)->firstOrFail();
        return view('pages.detail',compact('product'));
    }

    public function add(Request $request ,$id)
    {
        $data=[
            'products_id'=>$id,
            'user_id'=> Auth::user()->id,
        ];

        Cart::create($data);
        return redirect(route('cart'));
    }
}
