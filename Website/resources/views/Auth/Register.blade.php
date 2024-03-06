<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="container">
        @include('flash-message')
        @yield('content')
    </div>
    <main class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
               
                <div class="col-md-8">
                    <div class="card">
                       
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form action="{{ route('Auth.registration') }}" method="POST" onsubmit="return validateForm()">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name" required autofocus>
                                        <span id="name-error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" class="form-control" name="email" required autofocus>
                                        <span id="email-error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                        <span id="password-error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember">
                                            <label class="form-check-label">Remember Me</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <a class="btn btn-success btn-block" href="{{ route('Back') }}">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
    
    <!-- Bootstrap JS and Popper.js (required for some Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function validateForm() {
                var nameInput = document.getElementById('name');
                var emailInput = document.getElementById('email');
                var passwordInput = document.getElementById('password');
                var nameError = document.getElementById('name-error');
                var emailError = document.getElementById('email-error');
                var passwordError = document.getElementById('password-error');

                // Reset error messages
                nameError.textContent = '';
                emailError.textContent = '';
                passwordError.textContent = '';

                // Validate name
                if (nameInput.value.trim() === '') {
                    nameError.textContent = 'Name is required';
                    return false;
                }

                // Validate email
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    emailError.textContent = 'Invalid email format';
                    return false;
                }

                // Validate password
                var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]{6,}$/;
                if (!passwordRegex.test(passwordInput.value)) {
                    passwordError.textContent = 'Password must contain at least one alphabet, one number, and one special character (@#$%^&*!)';
                    return false;
                }

                return true; // Form is valid, proceed with submission
            }

            // Add event listeners for live validation
            document.getElementById('name').addEventListener('input', function () {
                validateForm();
            });

            document.getElementById('email').addEventListener('input', function () {
                validateForm();
            });

            document.getElementById('password').addEventListener('input', function () {
                validateForm();
            });
        });
    </script>
</body>

</html>
