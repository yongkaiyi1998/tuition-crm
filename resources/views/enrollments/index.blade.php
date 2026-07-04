@extends('layouts.app')

@section('title', 'Enrollments')
@section('page-title', 'Enrollments')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Enrollments</h5>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Add Enrollment</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Original Fee</th>
                    <th>Final Fee</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->student->name }}</td>
                        <td>{{ $enrollment->course->name }}</td>
                        <td>RM {{ $enrollment->original_fee }}</td>
                        <td>RM {{ $enrollment->final_fee }}</td>
                        <td>
                            @if($enrollment->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($enrollment->status == 'completed')
                                <span class="badge bg-primary">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('enrollments.destroy', $enrollment) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete enrollment?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection