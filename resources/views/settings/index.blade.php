@extends('layouts.app')

@section('title', 'Payments')
@section('page-title', 'Payments')
@section('content')

<form method="POST" action="{{ route('settings.store') }}">
    @csrf

    <div class="card card-shadow">

        <div class="card-header bg-white">
            <h5>System Settings</h5>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label>Company Name</label>
                <input name="company_name"
                       class="form-control"
                       value="{{ $settings['company_name']->value ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input name="email"
                       class="form-control"
                       value="{{ $settings['email']->value ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input name="phone"
                       class="form-control"
                       value="{{ $settings['phone']->value ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address"
                          class="form-control">{{ $settings['address']->value ?? '' }}</textarea>
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Save Settings</button>
        </div>

    </div>
</form>

@endsection