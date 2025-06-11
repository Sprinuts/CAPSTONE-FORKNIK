<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function createCheckout(Request $request)
    {
        $amount = 300.00; // or get dynamically
        $referenceNumber = Str::uuid();

        // Save invoice as pending
        $invoice = Invoice::create([
            'user_id' => session('user')->id, // or use session('user') if not using Laravel auth
            'reference_number' => $referenceNumber,
            'payment_status' => 'pending',
            'amount' => $amount,
        ]);

        $response = Http::withBasicAuth(env('PAYMAYA_PUBLIC_KEY'), env('PAYMAYA_SECRET_KEY'))
            ->post(env('PAYMAYA_ENDPOINT'), [
                'totalAmount' => [
                    'value' => $amount,
                    'currency' => 'PHP',
                    'details' => [
                        'discount' => 0,
                        'serviceCharge' => 0,
                        'shippingFee' => 0,
                        'tax' => 0,
                        'subtotal' => $amount
                    ]
                ],
                'buyer' => [
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'contact' => ['email' => 'john@example.com'],
                ],
                'redirectUrl' => [
                    'success' => route('payment.success', $invoice->id),
                    'failure' => route('payment.failed', $invoice->id),
                    'cancel'  => route('payment.cancelled', $invoice->id),
                ],
                'requestReferenceNumber' => $referenceNumber,
        ]);

        return redirect($response['redirectUrl']);
    }

    public function paymentSuccess($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'paid';
        $invoice->save();

        return view('appointment/paymentsuccess', compact('invoice'));
    }

    public function paymentFailed($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'failed';
        $invoice->save();

        return view('payment.failed');
    }

    public function paymentCancelled($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'cancelled';
        $invoice->save();

        return view('payment.cancelled');
    }
}
