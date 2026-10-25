<?php

namespace App\Services\Billing;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SubscriptionSync
{
    public function sync(string $id, string $customer): ?Subscription
    {
        if (! str_starts_with($id, 'sub_') || ! str_starts_with($customer, 'cus_')) {
            throw new RuntimeException('Invalid subscription identity.');
        }
        $user = User::where('stripe_id', $customer)->first();
        if (! $user) {
            return null;
        }

        return DB::transaction(function () use ($user, $id, $customer) {
            $user = User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            if ($user->stripe_id !== $customer) {
                throw new RuntimeException('Subscription owner changed.');
            }
            // Read current provider state under the user lock: delayed events cannot restore old access.
            $data = app(SubscriptionGateway::class)->subscription($id);
            if (($data['id'] ?? null) !== $id || ($data['customer'] ?? null) !== $customer) {
                throw new RuntimeException('Subscription customer mismatch.');
            }
            $items = $data['items']['data'] ?? [];
            $price = count($items) === 1 ? ($items[0]['price']['id'] ?? null) : null;
            $plan = $price ? Plan::where('is_free', false)->where('stripe_price', $price)->first() : null;
            $status = $data['status'] ?? 'incomplete';
            $end = $status === 'canceled' ? ($data['ended_at'] ?? time())
                : (($data['cancel_at'] ?? null) ?: (($data['cancel_at_period_end'] ?? false)
                    ? ($items[0]['current_period_end'] ?? $data['current_period_end'] ?? time()) : null));
            $eligible = $plan && $plan->is_active && in_array($status, ['active', 'trialing'], true)
                && (! $end || $end > time());
            $row = $user->subscriptions()->updateOrCreate(['stripe_id' => $id], [
                'shop_id' => $user->shop?->id, 'plan_id' => $plan?->id, 'type' => 'default',
                'payment_provider' => 'stripe', 'stripe_status' => $status, 'stripe_price' => $price,
                'quantity' => count($items) === 1 ? ($items[0]['quantity'] ?? 1) : null,
                'trial_ends_at' => isset($data['trial_end']) ? Carbon::createFromTimestamp($data['trial_end']) : null,
                'ends_at' => $end ? Carbon::createFromTimestamp($end) : null,
                'status' => $eligible ? 'active' : ($status === 'canceled' ? 'cancelled' : 'expired'),
            ]);
            foreach ($items as $item) {
                $row->items()->updateOrCreate(['stripe_id' => $item['id']], [
                    'stripe_product' => $item['price']['product'], 'stripe_price' => $item['price']['id'],
                    'quantity' => $item['quantity'] ?? 1,
                ]);
            }
            $row->items()->whereNotIn('stripe_id', array_column($items, 'id'))->delete();

            // Keep the original Free record available as a fallback. Never grant a paid plan from a redirect.
            return $row;
        }, 3);
    }
}
