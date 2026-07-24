@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Students</h5>
        <a href="{{ route('students.create') }}" class="btn btn-success">
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
                    placeholder="Search student..."
                    value="{{ request('search') }}"
                >
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
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
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
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm mx-2">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete student?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $students->links() }}
    </div>
</div>

@endsection