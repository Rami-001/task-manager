<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        nav {
            background-color: #eee;
            padding: 15px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        nav a {
            text-decoration: none;
            color: #0056b3;
            margin-right: 10px;
        }
        main {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            max-width: 400px;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], select, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            box-sizing: border-box;
        }
        button {
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #dc3545;
            padding: 5px 10px;
            color: white;
        }
        .login-btn {
            background-color: #2835a7ff;
            padding: 5px 10px;
            color: white;
        }
        .edit-btn {
            padding: 5px 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <nav>
        @guest
            <a href="{{ route('login') }}">Login</a> | 
            <a href="{{ route('register') }}">Register</a>
        @endguest

        @auth
            <span>Welcome, {{ Auth::user()->name }}</span> | 
            <a href="{{ route('tasks.index') }}">My Tasks</a> | 
            
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="login-btn">Logout</button>
            </form>
        @endauth
    </nav>

    <hr>

    <main>
        @yield('content')
    </main>

</body>
</html>