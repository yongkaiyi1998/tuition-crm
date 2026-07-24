@extends('layouts.app')

@section('title', 'Students')
@section('page-title', 'Students')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Add Student</h5>
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

        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input class="form-control mb-2" name="name" placeholder="Name">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input class="form-control mb-2" name="phone" placeholder="Phone">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control mb-2" name="email" placeholder="Email">
            </div>

            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('students.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">Create Student</button>
            </div>
        </form>
    </div>
</div>

@endsection