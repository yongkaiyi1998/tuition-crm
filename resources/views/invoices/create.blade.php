@extends('layouts.app')

@section('title', 'Invoices')
@section('page-title', 'Invoices')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Add Invoice</h5>
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

        <form method="POST" action="{{ route('invoices.store') }}">
            @csrf

            <div class="mb-4">
                <h6 class="text-muted mb-3">Invoice Summary</h6>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Student</small>
                            <div class="fs-5 fw-bold" id="student_name">-</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Course</small>
                            <div class="fs-5 fw-bold" id="course_name">-</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Amount</small>
                            <div class="fs-5 fw-bold" id="amount_preview">RM 0.00</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Select Enrollment</h6>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label>Enrollment <span class="text-danger">*</span></label>

                        <select name="enrollment_id" class="form-select" id="enrollment_id">
                            <option value="">Select Enrollment</option>

                            @foreach($enrollments as $enrollment)
                                <option
                                    value="{{ $enrollment->id }}"
                                    data-name="{{ $enrollment->student->name }}"
                                    data-course="{{ $enrollment->course_name }}"
                                    data-fee="{{ $enrollment->final_fee }}"
                                >
                                    {{ $enrollment->student->name }}
                                    -
                                    {{ $enrollment->course_name }}
                                    (RM {{ $enrollment->final_fee }})
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted mb-3">Editable Field</h6>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control">
                    </div>
                </div>
            </div>

            
            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('invoices.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">Create Invoice</button>
            </div>
        </form>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/invoice.js') }}"></script>
@endpush