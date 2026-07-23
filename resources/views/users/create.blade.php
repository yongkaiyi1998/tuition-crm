@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'Users')
@section('content')

<div class="card card-shadow">

    <div class="card-header bg-white">
        <h5 class="mb-0">Add User</h5>
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

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">User Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-control mb-2" name="role">
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="d-flex justify-content-between pt-3 border-top">
                <a href="{{ route('users.index') }}" class="btn btn-outline-danger">Back</a>
                <button class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>
</div>

@endsection