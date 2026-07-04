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

            <input class="form-control mb-2" name="name" placeholder="Name">
            <input class="form-control mb-2" name="phone" placeholder="Phone">
            <input class="form-control mb-2" name="email" placeholder="Email">

            <a href="{{ route('students.index') }}" class="btn btn-outline-danger">Back</a>
            <button class="btn btn-success">Create</button>
        </form>
    </div>
</div>

@endsection