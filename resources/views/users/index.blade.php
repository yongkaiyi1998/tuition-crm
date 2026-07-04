@extends('layouts.app')

@section('title', 'Users')
@section('page-title', 'Users')
@section('content')

<div class="card card-shadow">

    <div class="card-header d-flex justify-content-between">
        <h5>Users</h5>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="360">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-secondary">Staff</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('users.edit', $user) }}"
                            class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <button
                                type="button"
                                class="btn btn-secondary btn-sm btn-reset-password"
                                data-bs-toggle="modal"
                                data-bs-target="#passwordModal"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}">
                                Reset Password
                            </button>

                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete user?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('users.partials.reset-password-modal')

@endsection

@push('scripts')
<script src="{{ asset('js/user.js') }}"></script>
@endpush