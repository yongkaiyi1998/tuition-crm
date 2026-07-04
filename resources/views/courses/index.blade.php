@extends('layouts.app')

@section('title', 'Courses')
@section('page-title', 'Courses')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Courses</h5>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Fee</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->fee }}</td>
                        <td>{{ $course->duration . ' ' . ucfirst($course->duration_type) . '(s)' }}</td>
                        <td>
                            @if($course->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('courses.destroy', $course) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete courses?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection