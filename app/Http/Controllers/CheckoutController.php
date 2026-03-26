<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function process(Request $request, Product $product)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'g-recaptcha-response' => 'required'
        ]);

        // Verify ReCaptcha
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY', 'YOUR_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$recaptchaResponse->json('success')) {
            return back()->with('error', 'Google reCAPTCHA validation failed. Please try again.');
        }

        $amount = $product->discount_price ?? $product->price;

        $order = Order::create([
            'product_id' => $product->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'amount' => $amount,
            'ip' => $request->ip(),
            'type' => 0, // Pending
        ]);

        // Initialize Lahza Payment
        $url = "https://api.lahza.io/transaction/initialize";
        $fields = [
            'email' => $order->email,
            'mobile' => $order->phone,
            'firstname' => $order->first_name,
            'amount' => $order->amount * 100, // Lahza expects minor units usually
            'currency' => 'USD',
            'callback_url' => route('checkout.callback') . '/',
            'metadata' => [
                'order_id' => $order->id
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LAHZA_SECRET_KEY', 'sk_test_r3zc3PxoFJhEmMFhjBnJm5JXSP6cqn91f'),
            'Cache-Control' => 'no-cache',
        ])->post($url, $fields);

        if ($response->successful() && isset($response->json('data')['authorization_url'])) {
            $order->update([
                'reference_number' => $response->json('data')['reference']
            ]);
            
            return redirect($response->json('data')['authorization_url']);
        }

        Log::error('Lahza Initialization Failed:', $response->json());
        return back()->with('error', 'Failed to initialize payment gateway.');
    }

    public function callback(Request $request)
    {
        if (!isset($_GET['reference'])) {
            return redirect()->route('home')->with('error', 'Invalid payment reference.');
        }
        
        $ref = $_GET['reference'];
        $url = "https://api.lahza.io/transaction/verify/" . $ref;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env('LAHZA_SECRET_KEY', 'sk_test_r3zc3PxoFJhEmMFhjBnJm5JXSP6cqn91f'),
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $res = json_decode($result);

        if (isset($res->status) && $res->status == true) {
            $order = Order::where('reference_number', $res->data->reference)->first();

            if (!$order) {
                return redirect()->route('home')->with('error', 'Order not found.');
            }

            if ($res->data->status == 'success') {
                $order->type = 1; // Success
                $order->save();
                return redirect()->route('checkout.success', $order);
            } else {
                $order->type = 2; // Failed
                $order->save();
                return redirect()->route('checkout.failed', $order);
            }
        }

        return redirect()->route('home')->with('error', 'Payment verification failed.');
    }

    public function success(Order $order)
    {
        return view('frontend.checkout.success', compact('order'));
    }

    public function failed(Order $order)
    {
        return view('frontend.checkout.failed', compact('order'));
    }
}
