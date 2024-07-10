<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cfe0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #eff5f7;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center">Register</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <span class="error-message" id="name-error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="error-message" id="password-error"></span>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <span class="error-message" id="password_confirmation-error"></span>
            </div>
            <button type="submit" class="btn-primary">Sign Up</button>
        </form>
        <p style="text-align: center">Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registerForm');

            form.addEventListener('submit', function (event) {
                let valid = true;

                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;

                const nameError = document.getElementById('name-error');
                const emailError = document.getElementById('email-error');
                const passwordError = document.getElementById('password-error');
                const passwordConfirmationError = document.getElementById('password_confirmation-error');

                nameError.textContent = '';
                emailError.textContent = '';
                passwordError.textContent = '';
                passwordConfirmationError.textContent = '';

                if (name.length < 3 || name.length > 100) {
                    nameError.textContent = 'Name must be between 3 and 100 characters.';
                    valid = false;
                }

                const emailPattern = /^[a-z0-9\+_\-]+(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;
                if (!emailPattern.test(email)) {
                    emailError.textContent = 'Please enter a valid email address.';
                    valid = false;
                }

                if (password.length < 6 || password.length > 16) {
                    passwordError.textContent = 'Password must be between 6 and 16 characters.';
                    valid = false;
                }

                if (password !== passwordConfirmation) {
                    passwordConfirmationError.textContent = 'Password and confirmation password must match.';
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault();
                }
            });

            setTimeout(function () {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.display = 'none';
                });
            }, 2000);
        });
    </script>
</body>
</html>
