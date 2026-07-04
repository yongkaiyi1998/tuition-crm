@extends('layouts.app')

@section('title', 'Payments')
@section('page-title', 'Payments')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Payments</h5>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Add Payment</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Payment No</th>
                    <th>Invoice No</th>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td class="{{ $payment->status == 'cancelled' ? 'text-decoration-line-through text-danger' : '' }}">
                            {{ $payment->payment_no }}
                        </td>
                        <td>{{ $payment->invoice->invoice_no }}</td> 
                        <td>{{ $payment->invoice->enrollment->student->name }}</td> 
                        <td>RM {{ $payment->amount }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>
                            @if ($payment->status == 'paid')
                                <span class="badge bg-success">
                                    Paid
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Cancelled
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>
                            @if ($payment->status == 'paid')
                                <form method="POST" action="{{ route('payments.destroy', $payment) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Cancel payment?')">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>

                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection