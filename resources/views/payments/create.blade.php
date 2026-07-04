@extends('layouts.app')

@section('title', 'Payments')
@section('page-title', 'Payments')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Add Payment</h5>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('payments.store') }}">
            @csrf

            <div class="mb-4">

                <h6 class="text-muted mb-3">Invoice Summary</h6>

                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center">
                            <small class="text-muted d-block">Student</small>
                            <div class="fs-5 fw-bold" id="student_name">-</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center">
                            <small class="text-muted d-block">Course</small>
                            <div class="fs-5 fw-bold" id="course_name">-</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light text-center">
                            <small class="text-muted d-block">Balance</small>
                            <div class="fs-5 fw-bold text-danger" id="balance">RM 0.00</div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="mb-4">
                <h6 class="text-muted mb-3">Select Invoice</h6>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Invoice <span class="text-danger">*</span></label>
                        <select name="invoice_id" class="form-select" id="invoice_id">
                            <option value="">Select Invoice</option>
                            @foreach($invoices as $invoice)
                                <option
                                    value="{{ $invoice->id }}"
                                    data-student="{{ $invoice->enrollment->student->name }}"
                                    data-course="{{ $invoice->course_name }}"
                                    data-balance="{{ $invoice->balance }}"
                                >
                                    {{ $invoice->invoice_no }}
                                    -
                                    {{ $invoice->enrollment->student->name }}
                                    -
                                    {{ $invoice->course_name }}
                                    -
                                    RM {{ $invoice->balance }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Payment Details</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                        <input type="date" name="payment_date" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Method</label>
                        <input type="text" name="payment_method" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Reference No</label>
                        <input type="text" name="reference_no" class="form-control">
                    </div>

                </div>
            </div>

            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('payments.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">Create Payment</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/payment.js') }}"></script>
@endpush