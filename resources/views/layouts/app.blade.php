<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tuition CRM')</title>
    
    {{-- css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @stack('css')

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            background: #495057;
            color: white;
        }

        .sidebar-title {
            color: white;
            padding: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid #495057;
        }

        .content-wrapper {
            padding: 25px;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 25px;
        }

        .card-shadow {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,.05);
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 p-0 sidebar">

            <div class="sidebar-title">
                Tuition CRM
            </div>

            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-chart-line me-2"></i>
                Dashboard
            </a>

            <a href="{{ route('students.index') }}">
                <i class="fa-solid fa-user-graduate me-2"></i>
                Students
            </a>

            <a href="{{ route('courses.index') }}">
                <i class="fa-solid fa-book me-2"></i>
                Courses
            </a>

            <a href="{{ route('enrollments.index') }}">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                Enrollments
            </a>

            <a href="{{ route('invoices.index') }}">
                <i class="fa-solid fa-file-invoice me-2"></i>
                Invoices
            </a>

            <a href="{{ route('payments.index') }}">
                <i class="fa-solid fa-credit-card me-2"></i>
                Payments
            </a>

            @if(auth()->user()->role == 'admin')
                <a href="{{ route('users.index') }}">
                    <i class="fa-solid fa-users me-2"></i>
                    Users
                </a>

                <a href="{{ route('settings.index') }}">
                    <i class="fa-solid fa-gear me-2"></i>
                    Settings
                </a>
            @endif
        </div>

        <div class="col-md-10 p-0">

            <div class="topbar d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    @yield('page-title')
                </h5>

                <div>

                    {{ auth()->user()->name }}

                    <a href="/logout"
                       class="btn btn-sm btn-outline-danger ms-2">
                        Logout
                    </a>

                </div>

            </div>

            <div class="content-wrapper">

                @yield('content')

            </div>

        </div>

    </div>

</div>

{{-- components --}}
@include('components.toast')

{{-- js --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/toast.js') }}"></script>
@stack('scripts')

@if(session('success'))
    <script>
        $(function () {
            showToast("{{ session('success') }}", "success");
        });
    </script>
@endif

</body>
</html>