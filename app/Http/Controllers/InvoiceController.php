<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Enrollment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with(['enrollment.student'])->latest()->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::orderBy('enroll_date')->get();

        return view('invoices.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();

        $enrollment = Enrollment::with(['student', 'course'])->findOrFail($validated['enrollment_id']);
        
        $validated['student_name']  = $enrollment->student->name;
        $validated['course_name']   = $enrollment->course->name;
        $validated['amount']        = $enrollment->final_fee;
        $validated['balance']       = $enrollment->final_fee;
        $validated['invoice_no']    = 'TEMP';

        $invoice = Invoice::create($validated);

        $invoice->update([
            'invoice_no' => 'INV-' . date('Y') . '-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT),
        ]);

        return redirect()
                ->route('invoices.index')
                ->with('success', 'Invoice recorded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $enrollments = Enrollment::orderBy('enroll_date')->get();

        return view('invoices.edit', compact('enrollments', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $validated = $request->validated();

        $invoice->update($validated);

        return redirect()
                ->route('invoices.index')
                ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        
        return redirect()
                ->route('invoices.index')
                ->with('success', 'Invoice deleted successfully.');
    }
}
