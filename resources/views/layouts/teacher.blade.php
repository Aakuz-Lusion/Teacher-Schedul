<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Dashboard')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #f4f4f4;
        }
        nav {
            background: #333;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        nav ul li form {
            display: inline;
        }
        nav ul li button {
            background: none;
            border: none;
            color: white;
            text-decoration: underline;
            cursor: pointer;
            font-size: 16px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            margin: 10px 0;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th {
            background: #333;
            color: white;
            padding: 10px;
            text-align: left;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        table tr:hover {
            background: #f5f5f5;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #218838;
        }
    </style>
    @yield('styles')
</head>
<body>

<nav>
    <ul>
        <li><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('teacher.dashboard') }}#schedule">My Schedule</a></li>
        <li>
            <form action="{{ route('teacher.logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>

<div class="container">
    <h1>@yield('header', 'Dashboard')</h1>
    <p style="color: #666;">@yield('subtitle', '')</p>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

@yield('scripts')
</body>
</html>