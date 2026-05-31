<?php
namespace App\Http\Middleware;

use App\Models\Invoice;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $subscription = Subscription::where('user_id', auth()->id())->first();

        $isPro = $subscription && $subscription->plan_name === 'pro' 
                 && $subscription->status === 'active';

        if (!$isPro) {
            $invoiceCount = Invoice::where('user_id', auth()->id())
                ->whereMonth('created_at', now()->month)
                ->count();

            if ($invoiceCount >= 5) {
                return redirect()->route('subscription.index')
                    ->with('error', 'Free plan limit reached. Upgrade to Pro.');
            }
        }

        return $next($request);
    }
}