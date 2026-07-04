<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('invoice.enrollment.student')->latest()->get();

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoices = Invoice::with('enrollment.student')
                        ->where('status', '!=', 'paid')
                        ->get();

        return view('payments.create', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
        ]);

        $validated['payment_no']    = 'TEMP';

        $invoice = Invoice::findOrFail($request->invoice_id);

        $payment = Payment::create($validated);
        $payment->payment_no = 'PAY-' . date('Y') . '-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT);
        $payment->save();

        $invoice->recalculate();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment recorded successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_date' => 'required|date',
        ]);

        $payment->update($validated);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->update([
            'status' => 'cancelled'
        ]);

        $payment->invoice->recalculate();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment cancelled successfully.');
    }
}
