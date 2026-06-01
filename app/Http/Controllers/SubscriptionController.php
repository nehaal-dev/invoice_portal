<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscription = Subscription::where('user_id', auth()->id())->first();
        return view('subscription.index', compact('subscription'));
    }

    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => ['name' => 'Pro Plan - Invoice Portal'],
                    'unit_amount' => 99900, // ₹999
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.index'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($request->session_id);

        if ($session->payment_status === 'paid') {
            Subscription::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'plan_name'  => 'pro',
                    'status'     => 'active',
                    'amount'     => 999,
                    'start_at'  => now(),
                    'expires_at' => now()->addMonth(),
                ]
            );
        }

        return redirect()->route('subscription.index');
    }
}