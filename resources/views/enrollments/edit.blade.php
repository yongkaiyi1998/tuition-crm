@extends('layouts.app')

@section('title', 'Enrollments')
@section('page-title', 'Enrollments')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Enrollment</h5>
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
        
        <form method="POST" action="{{ route('enrollments.update', $enrollment->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Student <span class="text-danger">*</span></label>
                <select name="student_id" class="form-select">
                    <option value=""> Select Student </option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Course <span class="text-danger">*</span></label>
                <select name="course_id" id="course_id" class="form-select">
                    <option value=""> Select Course </option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" data-fee="{{ $course->fee }}" {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }} ( RM {{ $course->fee }} )</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Course Fee <span class="text-danger">*</span></label>
                <input type="number" step="0.01" min="0" name="final_fee" id="final_fee" class="form-control" value="{{ old('final_fee', $enrollment->final_fee) }}">
            </div>

            <div class="mb-3">
                <label>Enroll Date <span class="text-danger">*</span></label>
                <input type="date" name="enroll_date" class="form-control" value="{{ old('enroll_date', $enrollment->enroll_date) }}">
            </div>

            <div class="mb-3">
                <label>Status <span class="text-danger">*</span></label>
                <select class="form-control mb-2" name="status">
                    <option value="active" {{ $enrollment->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ $enrollment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <a href="{{ route('enrollments.index') }}" class="btn btn-outline-danger">Back</a>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/enrollment.js') }}"></script>
@endpush