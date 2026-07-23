@extends('layouts.app')

@section('title', 'Courses')
@section('page-title', 'Courses')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Add Course</h5>
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
        
        <form method="POST" action="{{ route('courses.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Course Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Fee (RM) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" min="0" name="fee" class="form-control" value="{{ old('fee') }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="number" min="1" name="duration" class="form-control" value="{{ old('duration') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Duration Type</label>
                        <select name="duration_type" class="form-select">
                            <option value="">Select</option>
                            <option value="day">Day</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('courses.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">Create Course</button>
            </div>
        </form>
    </div>
</div>

@endsection