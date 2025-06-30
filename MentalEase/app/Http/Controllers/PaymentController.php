<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Users;
use Barryvdh\DomPDF\Facade\Pdf;
// If the above doesn't work, try the following alternative:
// use PDF; // If you're using the facade alias defined in config/app.php

class PaymentController extends Controller
{
    public function createCheckout(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'psychometrician_id' => $request->psychometrician_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => \Carbon\Carbon::parse($request->start_time)->addHour(),
        ];

        $amount = 500.00; // or get dynamically
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
                    'success' => route('payment.success', ['id' => $invoice->id, 'data' => json_encode($data)]),
                    'failure' => route('payment.failed', $invoice->id),
                    'cancel'  => route('payment.cancelled', $invoice->id),
                ],
                'requestReferenceNumber' => $referenceNumber,
        ]);

        return redirect($response['redirectUrl']);
    }

    public function paymentSuccess(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'paid';
        $invoice->save();

        // Retrieve and decode the 'data' parameter from the query string
        $data = [];
        if ($request->has('data')) {
            $data = json_decode($request->query('data'), true);
        }

        // Find the schedule ID based on the appointment details
        $schedule = Schedule::where('psychometrician_id', $data['psychometrician_id'])
            ->where('date', $data['date'])
            ->where('start_time', $data['start_time'])
            ->first();

        // Create the appointment and set the invoice_id
        $appointment = Appointment::create([
            'user_id' => $data['user_id'],
            'psychometrician_id' => $data['psychometrician_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => \Carbon\Carbon::parse($data['start_time'])->addHour(),
            'invoice_id' => $invoice->id, // Set invoice_id in appointment
        ]);

        // Update the invoice with the schedule_id and appointment_id
        if ($schedule) {
            $invoice->schedule_id = $schedule->id;
        }
        $invoice->appointment_id = $appointment->id;
        $invoice->save();

        // Update the schedule's 'scheduled' column to true
        if ($schedule) {
            $schedule->scheduled = true;
            $schedule->save();
        }

        $user = Users::find($data['user_id']);
        // Log the appointment creation
        \App\Models\Logs::create([
            'name' => $user->username,
            'log' => ' scheduled an appointment',
            'type' => 'appointment'
        ]);

        return view('include/header')
            .view('include/navbar')
            .view('appointment/paymentsuccess', compact('invoice'));
    }

    public function paymentFailed($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'failed';
        $invoice->save();

        return view('include/header')
            .view('include/navbar')
            .view('appointment/paymentfailed');
    }

    public function paymentCancelled($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'cancelled';
        $invoice->save();

        return view('include/header')
            .view('include/navbar')
            .view('appointment/paymentcancelled');
    }

    public function paymentrecords()
    {
        $invoices = Invoice::all();

        foreach ($invoices as $invoice) {
            if ($invoice->user_id) {
                $client = Users::find($invoice->user_id);
                $invoice->client = $client;
            } else {
                $invoice->client = null;
            }
        }
        
        return view('include/headercashier')
            .view('include/navbarcashier')
            .view('appointment/paymentrecords', compact('invoices'));
    }

    /**
     * Display the payment reports page with financial data
     */
    public function paymentReports()
    {
        // Get today's date and date ranges
        $today = now()->format('Y-m-d');
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');
        
        // Calculate revenue metrics
        $todayRevenue = Invoice::whereDate('created_at', $today)->sum('amount');
        $weeklyRevenue = Invoice::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('amount');
        $monthlyRevenue = Invoice::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('amount');
        
        // Get payment methods breakdown
        $paymentMethods = Invoice::selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
            ->where('payment_status', 'paid')
            ->groupBy('payment_method')
            ->get();
        
        // Get service types breakdown
        $serviceTypes = Invoice::selectRaw('service_type, COUNT(*) as count, SUM(amount) as total')
            ->where('payment_status', 'paid')
            ->groupBy('service_type')
            ->get();
        
        return view('include/headercashier')
            .view('include/navbarcashier')
            .view('payment.reports', compact(
                'todayRevenue',
                'weeklyRevenue',
                'monthlyRevenue',
                'paymentMethods',
                'serviceTypes'
            ));
    }


    public function generateReceipt($id)
    {
        $invoice = Invoice::with('client')->findOrFail($id);
        
        return view('include/headercashier')
            .view('include/navbarcashier')
            .view('payment.receipt', compact('invoice'));
    }

    public function paymentReceiptsList()
    {
        $invoices = Invoice::with('client')->where('payment_status', 'paid')->get();
        
        return view('include/headercashier')
            .view('include/navbarcashier')
            .view('payment.receipts', compact('invoices'));
    }

    public function generateReceiptPdf($id)
    {
        $invoice = Invoice::with('client')->findOrFail($id);
        
        // Return a print-specific view
        return view('payment.receipt-print', compact('invoice'));
    }

    public function patientReceipt($id)
    {
        // First try to find by invoice ID
        $invoice = Invoice::with(['appointment.psychometrician'])->find($id);
        
        // If not found, try to find by appointment ID
        if (!$invoice) {
            $appointment = Appointment::find($id);
            if ($appointment) {
                $invoice = Invoice::with(['appointment.psychometrician'])
                    ->where('appointment_id', $appointment->id)
                    ->first();
                
                // If still no invoice, create a placeholder for display
                if (!$invoice) {
                    $invoice = new Invoice();
                    $invoice->appointment = $appointment;
                    $invoice->amount = $appointment->fee ?? 500;
                    $invoice->reference_number = 'N/A';
                    $invoice->payment_method = 'online';
                    $invoice->created_at = now();
                }
            }
        }
        
        if (!$invoice) {
            return redirect()->back()->with('error', 'Receipt not found.');
        }
        
        // Check if the current user owns this appointment/invoice
        if (session('user')->id != ($invoice->user_id ?? $invoice->appointment->user_id ?? null)) {
            return redirect()->back()->with('error', 'You do not have permission to view this receipt.');
        }
        
        return view('include/header')
            .view('include/navbar')
            .view('appointment.patientreceipt', compact('invoice'));
    }

}











