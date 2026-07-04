@extends('layouts.app')

@section('title', 'Invoices')
@section('page-title', 'Edit Invoice')

@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Invoice</h5>
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


        <form method="POST" action="{{ route('invoices.update', $invoice->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <h6 class="text-muted mb-3">Invoice Information</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Invoice No</label>
                        <input type="text" class="form-control bg-light" value="{{ $invoice->invoice_no }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Student</label>
                        <input type="text" class="form-control bg-light" value="{{ $invoice->student_name }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Course</label>
                        <input type="text" class="form-control bg-light" value="{{ $invoice->course_name }}" readonly>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Financial Summary</h6>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Amount</small>
                            <div class="fs-5 fw-bold">
                                RM {{ number_format($invoice->amount, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Balance</small>
                            <div class="fs-5 fw-bold text-danger">
                                RM {{ number_format($invoice->balance, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Status</small>
                            <div class="fs-5 fw-bold">
                                {{ ucfirst($invoice->status) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Editable Fields</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $invoice->due_date) }}">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('invoices.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">Update Invoice</button>
            </div>

        </form>

    </div>
</div>

@endsection