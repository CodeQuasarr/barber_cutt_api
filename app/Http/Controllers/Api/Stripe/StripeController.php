<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{

    public function getCheckoutSession() {
        $stripe = new StripeClient(config('stripe.test_secret_key'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost:8080/success',
            'cancel_url' => 'http://localhost:8080/cancel',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => 'Stubborn Attachments',
                            'description' => 'A pair of socks',
                            'images' => ["https://i.imgur.com/EHyR2nP.png"],
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return response()->json(["id" => $checkout->id]);
    }
}
