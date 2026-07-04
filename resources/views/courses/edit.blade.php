@extends('layouts.app')

@section('title', 'Courses')
@section('page-title', 'Courses')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Courses</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('courses.update', $course->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Course Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Fee (RM) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" min="0" name="fee" class="form-control" value="{{ old('fee', $course->fee) }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="number" min="1" name="duration" class="form-control" value="{{ old('duration', $course->duration) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Duration Type</label>
                        <select name="duration_type" class="form-select">
                            <option value="">Select</option>
                            <option value="day" {{ old('duration_type', $course->duration_type) == 'day' ? 'selected' : '' }}>Day</option>
                            <option value="week" {{ old('duration_type', $course->duration_type) == 'week' ? 'selected' : '' }}>Week</option>
                            <option value="month" {{ old('duration_type', $course->duration_type) == 'month' ? 'selected' : '' }}>Month</option>
                            <option value="year" {{ old('duration_type', $course->duration_type) == 'year' ? 'selected' : '' }}>Year</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control mb-2" name="status">
                            <option value="active" {{ $course->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $course->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <a href="{{ route('courses.index') }}" class="btn btn-outline-danger">Back</a>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection