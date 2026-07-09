<!DOCTYPE html>
<html>
<head>
    <title>Teacher Scheduler</title>
    <style>
        body {
            font-family: Times New Roman, Times, serif;
            text-align: center;
            padding: 80px 20px;
            background: #194d6e;
        }
        h1 {
            font-size: 48px;
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            font-size: 18px;
        }
        .buttons {
            margin-top: 40px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-green {
            background: #28a745;
        }
        .btn-green:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <h1>(●'◡'●) Teacher Scheduler</h1>
    <p>Efficiently manage teachers, schedules, and replacements</p>

    <div class="buttons">
        <a href="{{ route('admin.login') }}" class="btn">Admin Login</a>
        <a href="{{ route('teacher.login') }}" class="btn btn-green">Teacher Login</a>
    </div>
</body>
</html>