<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CreditController extends Controller
{
    public function credit()
    {

         $token = $this->getToken();
        $order = $this->createOrder($token);
        $paymentToken = $this->getPaymentToken($order, $token);
        return \Redirect::away('http://portal.weaccept.co/api/acceptance/iframes/' . env('PAYMOB_IFRAME_ID') . '?payment_token=' . $paymentToken);

    }

    public function getToken()
    {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
            'api_key' => env('PAYMOB_API_KEY')
        ]);
        return $response->object()->token;
    }

    public function createOrder($token)
    {
        $carts = Cart::with(['product' => function ($q) {
            $q->select('title', 'summary', 'id');
        }])->where('user_id', backpack_auth()->user()->id)->where('order_id', null)->get();
        $items = [];
        foreach ($carts as $cart) {
            array_push($items, [
                'name' => $cart->product->title,
                'amount_cents' => $cart->amount * 100,
                'description' => $cart->product->title,
                'quantity' => $cart->quantity,
            ]);
        }
        $data = [
            "auth_token" => $token,
            "delivery_needed" => "false",
            "amount_cents" => "100",
            "currency" => "EGP",
            "merchant_order_id" => 652602,
            "items" => $items,
            "shipping_data" => [
                "apartment" => "803",
                "email" => "claudette09@exa.com",
                "floor" => "42",
                "first_name" => "Clifford",
                "street" => "Ethan Land",
                "building" => "8028",
                "phone_number" => "+86(8)9135210487",
                "postal_code" => "01898",
                "extra_description" => "8 Ram , 128 Giga",
                "city" => "Jaskolskiburgh",
                "country" => "CR",
                "last_name" => "Nicolas",
                "state" => "Utah"
            ],
            "shipping_details" => [
                "notes" => " test",
                "number_of_packages" => 1,
                "weight" => 1,
                "weight_unit" => "Kilogram",
                "length" => 1,
                "width" => 1,
                "height" => 1,
                "contents" => "product of some sorts"
            ]

        ];
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);
        return $response->object();
    }

    public function getPaymentToken($order, $token)
    {

        $billingData = [
            "apartment" => "803",
            "email" => "claudette09@exa.com",
            "floor" => "42",
            "first_name" => "Clifford",
            "street" => "Ethan Land",
            "building" => "8028",
            "phone_number" => "+86(8)9135210487",
            "shipping_method" => "PKG",
            "postal_code" => "01898",
            "city" => "Jaskolskiburgh",
            "country" => "CR",
            "last_name" => "Nicolas",
            "state" => "Utah"
        ];
        $data = [
            "auth_token" => $token,
            "amount_cents" => "100",
            "expiration" => 3600,
            "order_id" => "87598104",
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_INTEGRATION_ID')
        ];
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        return $response->object()->token;
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        dd($data);
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if (in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC');
        $hased = hash_hmac('sha512', $connectedString, $secret);
        if ($hased == $hmac) {
            echo "secure";
            exit;
        }
        echo 'not secure';
        exit;
    }
}
