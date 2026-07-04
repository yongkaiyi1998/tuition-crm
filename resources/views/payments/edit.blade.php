@extends('layouts.app')

@section('title', 'Payments')
@section('page-title', 'Edit Payment')

@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Payment</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('payments.update', $payment->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <h6 class="text-muted mb-3">Payment Info</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Payment No</label>
                        <input type="text" class="form-control bg-light" value="{{ $payment->payment_no ?? ('PAY-' . $payment->id) }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Invoice No</label>
                        <input type="text" class="form-control bg-light" value="{{ $payment->invoice->invoice_no }}" readonly>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Amount</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted d-block">Payment Amount</small>
                            <div class="fs-5 fw-bold">
                                RM {{ number_format($payment->amount, 2) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Editable Fields</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Payment Date</label>
                        <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Method</label>
                        <input type="text" name="payment_method" class="form-control" value="{{ old('payment_method', $payment->payment_method) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Reference No</label>
                        <input type="text" name="reference_no" class="form-control" value="{{ old('reference_no', $payment->reference_no) }}">
                    </div>

                </div>
            </div>

            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('payments.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">
                    Update Payment
                </button>
            </div>

        </form>

    </div>
</div>

@endsection