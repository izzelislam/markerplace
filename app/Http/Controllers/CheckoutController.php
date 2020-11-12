<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Model\Transaction;
use App\Model\TransactionDetail;
use App\Model\Cart;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // proses_checkout
        $code='STORE-'.mt_rand(00000 , 99999);
        $carts =Cart::with(['product','user'])->where('user_id',Auth::user()->id)->get();
        
        // transaction_create
        $transaction= Transaction::create([
            'user_id' => Auth::user()->id,
            'inscurance_price' => 0,
            'shipping_price' => 0,
            'total' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        foreach ($carts as $cart) {
            $trx='TRX-'.mt_rand(00000 , 99999);

            TransactionDetail::create([
                'transactions_id' =>$transaction->id,
                'prodects_id' => $cart->product->id,
                'price_id' => $cart->product->price,
                'resi' => 'PENDING',
                'shipping_status' => '',
                'code' => $trx,
            ]);
        }

        // hapus cart setelah check out
        Cart::where('user_id',Auth::user()->id)->delete();

        // konfigurasi_mitrans
        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // dikirim ke midtrans
        $midtrans =[
            'transaction_details' =>[
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' =>Auth::user()->email,
            ],
            'enebled_payments'=>[
                'gopay','permata_va','bank_transfer'
            ],
            'vtweb' =>[]
        ];

        try { 
        // Get Snap Payment Page URL
        $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
        
        // Redirect to Snap Payment Page
          return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        # code...
    }
}
