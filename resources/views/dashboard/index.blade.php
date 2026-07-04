@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')

<div class="card card-shadow">

    <div class="card-body">

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card card-shadow">
                    <div class="card-body">
                        <small class="text-muted">Students</small>
                        <h2>{{ $totalStudents }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-shadow">
                    <div class="card-body">
                        <small class="text-muted">Active Courses</small>
                        <h2>{{ $activeCourses }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-shadow">
                    <div class="card-body">
                        <small class="text-muted">Revenue</small>
                        <h2>RM {{ number_format($totalRevenue,2) }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-shadow">
                    <div class="card-body">
                        <small class="text-muted">Outstanding</small>
                        <h2 class="text-danger">
                            RM {{ number_format($outstanding,2) }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card card-shadow h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Recent Payments</h6>
                        <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Payment No</th>
                                    <th>Student</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($recentPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_no }}</td>
                                        <td>{{ $payment->invoice->enrollment->student->name }}</td>
                                        <td class="text-end">RM {{ number_format($payment->amount,2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">NO PAYMENT FOUND.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card card-shadow h-100">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Outstanding Invoices</h6>
                        <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Student</th>
                                    <th class="text-end">Balance</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($outstandingInvoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->enrollment->student->name }}</td>
                                        <td class="text-end text-danger fw-bold">RM {{ number_format($invoice->balance,2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">NO OUTSTANDING INVOICE.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection