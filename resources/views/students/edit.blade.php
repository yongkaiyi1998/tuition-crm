@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Student</h5>
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
        
        <form method="POST" action="{{ route('students.update', $student->id) }}">
            @csrf
            @method('PUT')

            <input class="form-control mb-2" name="name" value="{{ $student->name }}">
            <input class="form-control mb-2" name="phone" value="{{ $student->phone }}">
            <input class="form-control mb-2" name="email" value="{{ $student->email }}">

            <select class="form-control mb-2" name="status">
                <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <a href="{{ route('students.index') }}" class="btn btn-outline-danger">Back</a>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection