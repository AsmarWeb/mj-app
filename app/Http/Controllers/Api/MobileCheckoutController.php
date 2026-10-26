<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobileCheckoutRequest;
use App\Models\Order;
use App\Services\Checkout\CheckoutIdentityException;
use App\Services\Checkout\PhysicalCheckoutService;
use App\Services\Checkout\StripeCheckoutGateway;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;

class MobileCheckoutController extends Controller
{
    public function store(MobileCheckoutRequest $request, PhysicalCheckoutService $checkout)
    {
        $this->verified($request);
        $data = $request->validated();
        $address = array_diff_key($data, array_flip(['shop_id', 'request_key']));
        $address['country'] = 'AE';
        try {
            $result = $checkout->start($request->user(), (int) $data['shop_id'], $address, $data['request_key']);
        } catch (ApiErrorException $error) {
            $pending = $request->user()->orders()->where('shop_id', $data['shop_id'])->where('inventory_reserved', true)->latest('id')->first();

            return $this->unavailable($pending);
        } catch (CheckoutIdentityException $error) {
            return $this->review(null);
        }

        return $this->state($result['order'], $result['url']);
    }

    public function resume(Request $request, string $order, PhysicalCheckoutService $checkout)
    {
        $row = $this->owned($request, $order);
        if ($this->closed($row)) {
            return $this->state($row);
        }
        try {
            $result = $checkout->resume($row);
        } catch (ApiErrorException $error) {
            return $this->unavailable($row);
        } catch (CheckoutIdentityException $error) {
            return $this->review($row);
        }

        return $this->state($result['order'], $result['url']);
    }

    public function refresh(Request $request, string $order, PhysicalCheckoutService $checkout, StripeCheckoutGateway $gateway)
    {
        $row = $this->owned($request, $order);
        if ($this->closed($row)) {
            return $this->state($row);
        }
        if (! $row->stripe_checkout_session_id) {
            return response()->json(['message' => 'The checkout session is not saved. Resume this checkout with the same order; do not create another payment.',
                'code' => 'CHECKOUT_RECOVERY_REQUIRED', 'order_id' => $row->id], 409);
        }
        try {
            $session = $gateway->retrieve($row->stripe_checkout_session_id);
            $checkout->assertIdentity($row, $session);
            $checkout->synchronize($session);
        } catch (ApiErrorException $error) {
            return $this->unavailable($row);
        } catch (CheckoutIdentityException $error) {
            return $this->review($row);
        }

        return $this->state($row->fresh());
    }

    public function cancel(Request $request, string $order, PhysicalCheckoutService $checkout)
    {
        $row = $this->owned($request, $order);
        if ($this->closed($row)) {
            return $this->state($row);
        }
        try {
            $checkout->cancel($row);
        } catch (ApiErrorException $error) {
            return $this->unavailable($row);
        } catch (CheckoutIdentityException $error) {
            return $this->review($row);
        }

        return $this->state($row->fresh());
    }

    private function owned(Request $request, string $id): Order
    {
        $this->verified($request);
        $order = $request->user()->orders()->whereKey($id)->firstOrFail();
        abort_unless($order->checkout_currency === 'AED' && $order->checkout_token
            && ($order->checkout_payload['metadata']['client_channel'] ?? null) === 'mobile_v1', 404);

        return $order;
    }

    private function verified(Request $request): void
    {
        abort_unless($request->user()->hasVerifiedEmail(), 403, 'Verify your email before checkout.');
    }

    private function closed(Order $order): bool
    {
        return in_array($order->payment_status, ['paid', 'refunded'], true) || $order->checkout_state === 'expired';
    }

    private function state(Order $order, ?string $url = null)
    {
        return response()->json(['data' => ['order_id' => $order->id, 'order_number' => $order->order_number,
            'status' => $order->status, 'payment_status' => $order->payment_status,
            'checkout_state' => $order->checkout_state, 'currency' => $order->checkout_currency,
            'total' => (string) $order->total, 'checkout_url' => $url,
            'expires_at' => $order->checkout_expires_at?->toISOString()]]);
    }

    private function review(?Order $order)
    {
        return response()->json(['message' => 'This checkout requires reconciliation. Do not start another payment.',
            'code' => 'CHECKOUT_REVIEW_REQUIRED', 'order_id' => $order?->id], 409);
    }

    private function unavailable(?Order $order)
    {
        return response()->json(['message' => 'Payment provider is temporarily unavailable. Resume or refresh the original checkout; do not start another payment.',
            'code' => 'PAYMENT_PROVIDER_UNAVAILABLE', 'order_id' => $order?->id], 503);
    }
}
