@extends('layouts.app')

@section('title', 'Invoices')
@section('page-title', 'Invoices')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Invoices</h5>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add Invoice</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Balance</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_no }}</td>
                        <td>{{ $invoice->enrollment->student->name }}</td>
                        <td>RM {{ $invoice->amount }}</td>
                        <td>RM {{ $invoice->balance }}</td>
                        <td>{{ $invoice->due_date ?? 'N/A' }}</td>
                        <td>
                            @if($invoice->status == 'unpaid')
                                <span class="badge bg-secondary">Unpaid</span>
                            @elseif($invoice->status == 'partial')
                                <span class="badge bg-warning">Partial</span>
                            @elseif($invoice->status == 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('invoices.destroy', $invoice) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete invoice?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection