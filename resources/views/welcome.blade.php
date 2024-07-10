<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .user-details {
            margin-bottom: 20px;
        }
        .user-details h1 {
            margin: 0 0 10px;
            text-align: center;
        }
        .user-details p {
            margin: 5px 0;
            text-align: center;
        }
        .btn-container {
            display: flex;
            justify-content: center;
        }
        .btn-primary {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
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
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center">Dashboard</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="user-details">
            <h1>Welcome, {{ auth()->user()->name }}</h1>
            <p>Email: {{ auth()->user()->email }}</p>
        </div>
        <div class="btn-container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-primary">Logout</button>
            </form>
        </div>
    </div>
<script>
    setTimeout(function () {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 2000);
});
</script>
</body>
</html>
