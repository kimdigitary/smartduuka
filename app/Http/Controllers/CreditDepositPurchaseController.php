<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\CreditDepositPurchase;
use App\Models\Order;
use Illuminate\Http\Request;

class CreditDepositPurchaseController extends Controller
{
    public function index($orderId)
    {
        // Fetch the CreditDepositPurchase based on the provided order ID
        $creditDepositPurchase = CreditDepositPurchase::where('order_id', $orderId)->get();

        // Check if the CreditDepositPurchase exists
        if ($creditDepositPurchase->isEmpty()) {
            return response()->json(['error' => 'Credit deposit purchase not found'], 404);
        }

        // Modify the date format for each payment
        $formattedPayments = $creditDepositPurchase->map(function ($payment) {
            // Format the date as Month Date, Year (e.g., January 1, 2023)
            $payment['created_at'] = date('M d, Y', strtotime($payment['created_at']));
            $payment['updated_at'] = date('M d, Y', strtotime($payment['updated_at']));
            return $payment;
        });

        // Return the modified payments as JSON response
        return response()->json(['payments' => $formattedPayments]);
    }

    public function updateBalance(Request $request, $orderId) {
        $creditDepositPurchase = CreditDepositPurchase::where('order_id', $orderId)
            ->latest()
            ->first();

        if ($creditDepositPurchase->balance <= 0) {
            return response()->json(['message' => 'Balance is already 0. No action taken.']);
        }

        $order = Order::find($orderId);

        $saveCreditPurchase = new CreditDepositPurchase();
        $saveCreditPurchase->order_id = $orderId;
        $saveCreditPurchase->user_id = $creditDepositPurchase->user_id;
        $saveCreditPurchase->type = ($order->order_type == 20) ? 'credit' : 'deposit';
        $saveCreditPurchase->paid = $request->amount;
        $saveCreditPurchase->balance = $creditDepositPurchase->balance - $request->amount;
        $saveCreditPurchase->save();


        if ($saveCreditPurchase->balance == 0) {
            $order->update([
                'payment_status' => PaymentStatus::PAID
            ]);
        }

        return response()->json(['message' => 'Balance updated successfully']);
    }
}
