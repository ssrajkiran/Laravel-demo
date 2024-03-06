<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>

    <!-- Validation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('email').addEventListener('input', validateEmail);
            document.getElementById('password').addEventListener('input', validatePassword);

            function validateEmail() {
                var emailInput = document.getElementById('email');
                var emailError = document.getElementById('email-error');
                var isValid = /\S+@\S+\.\S+/.test(emailInput.value);

                if (!isValid) {
                    emailError.textContent = 'Invalid email format';
                } else {
                    emailError.textContent = '';
                }
            }

            function validatePassword() {
                var passwordInput = document.getElementById('password');
                var passwordError = document.getElementById('password-error');
                var isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(passwordInput.value);

                if (!isValid) {
                    passwordError.textContent = 'Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, and one digit';
                } else {
                    passwordError.textContent = '';
                }
            }
        });
    </script>
</head>

<body>
    <div class="container">
        @include('flash-message')
        @yield('content')
    </div>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Login</h3>
                <div class="card-body">

                    <!-- Your existing login form goes here -->

                    <form method="POST" action="{{ route('Auth.login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Email" id="email" class="form-control" name="email" required>
                            <span id="email-error" class="text-danger"></span>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                            <span id="password-error" class="text-danger"></span>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="{{ route('Auth.register_page') }}">Register</a></p>
            </div>
             
            <div class="mb-3 row">
                <div class="col-md-6 mt-3 mt-md-0">
                    <a class="btn btn-success btn-block" href="{{ route('Back') }}">Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for some Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
