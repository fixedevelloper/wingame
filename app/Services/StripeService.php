<?php


namespace App\Services;


use App\Helpers\Helpers;
use Stripe\Stripe;

class StripeService
{
    public function payment_process_3d($amount,$id)
    {
        $tran = Helpers::generatenumber();
        session()->put('transaction_ref', $tran);


        Stripe::setApiKey(env('STRIPE_APIKEY'));
        header('Content-Type: application/json');
        $currency_code = "USD";


        $currencies_not_supported_cents = ['BIF', 'CLP', 'DJF', 'GNF', 'JPY', 'KMF', 'KRW', 'MGA', 'PYG', 'RWF', 'UGX', 'VND', 'VUV', 'XAF', 'XOF', 'XPF'];

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency_code??'usd',
                    'unit_amount' => $amount,
                    'product_data' => [
                        'name' => 'Win Foot',
                        'images' => []
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe_success',['id'=>$id,'ref'=>$tran]),
            'cancel_url' => route('stripe_echec',['id'=>$id]),
        ]);

        return ['id' => $checkout_session->url];
    }
}
