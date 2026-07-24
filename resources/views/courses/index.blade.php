@extends('layouts.app')

@section('title', 'Courses')
@section('page-title', 'Courses')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Courses</h5>
        <a href="{{ route('courses.create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
        </a>
    </div>

    <div class="card-body">

        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-5">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search course..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" @selected(request('status') == 'active')>Active</option>
                    <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                </select>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search me-1"></i> Search
                </button>
            </div>

            <div class="col-auto">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                    <i class="fa fa-rotate-left me-1"></i> Reset
                </a>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Fee</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th width="180" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->fee }}</td>
                        <td>{{ $course->duration . ' ' . ucfirst($course->duration_type) . '(s)' }}</td>
                        <td>
                            @if($course->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-warning">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm mx-2">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('courses.destroy', $course) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete courses?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No course found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $courses->links() }}
    </div>
</div>

@endsection