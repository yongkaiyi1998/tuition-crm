@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Students</h5>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @if($student->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete student?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection