<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container" style="max-width:400px">

    <h3 class="mb-3">CRM Login</h3>

    <form method="POST" action="/login">
        @csrf

        <input class="form-control mb-2" name="email" placeholder="Email">
        <input class="form-control mb-2" name="password" type="password" placeholder="Password">

        <button class="btn btn-primary w-100 mb-2">Login</button>
        <a href="/register" class="btn btn-primary w-100">
            Signup
        </a>
    </form>

</div>

</body>
</html>