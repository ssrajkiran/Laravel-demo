<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="container mt-5">
        @include('flash-message')

        <h1 class="text-center mb-4" style="padding-bottom: 15ch">Welcome to the Home Page</h1>

        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <a class="btn btn-success btn-block" href="{{ route('Auth.login_page') }}">User Login</a>
            </div>

            <div class="col-md-6 text-center mt-3 mt-md-0">
                <a class="btn btn-success btn-block" href="{{ route('Auth.register_page') }}">User Register</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for some Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
