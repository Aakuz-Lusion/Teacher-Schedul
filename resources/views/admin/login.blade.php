<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0a0e1a;
            padding: 20px;
            background-image: 
                radial-gradient(ellipse at 10% 20%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.10) 0%, transparent 50%);
        }
        .login-box {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }
        .logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .logo .icon {
            font-size: 48px;
            display: block;
            margin-bottom: 8px;
        }
        .logo h1 {
            color: #f1f5f9;
            font-size: 28px;
            font-weight: 700;
        }
        .logo p {
            color: rgba(255,255,255,0.3);
            font-size: 14px;
            margin-top: 4px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            margin-bottom: 6px;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #6366f1;
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.3);
        }
        .error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.15);
            border-radius: 12px;
            padding: 12px 16px;
            color: #fca5a5;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .error ul {
            list-style: none;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.2);
            font-size: 12px;
        }
        .footer a {
            color: rgba(255, 255, 255, 0.3);
            text-decoration: none;
        }
        .footer a:hover {
            color: rgba(255, 255, 255, 0.5);
        }
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
            color: rgba(255,255,255,0.15);
            font-size: 12px;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.06);
        }
        .teacher-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.3);
        }
        .teacher-link a {
            color: #818cf8;
            text-decoration: none;
        }
        .teacher-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="logo">
            <span class="icon">👑</span>
            <h1>Admin Login</h1>
            <p>Access the management dashboard</p>
        </div>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="admin@school.com" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn">Login as Admin</button>
        </form>

        <div class="divider">or</div>

        <div class="teacher-link">
            <a href="{{ route('teacher.login') }}">👨‍🏫 Login as Teacher</a>
        </div>

        <div class="footer">
            <p>Secure admin access only</p>
        </div>
    </div>
</body>
</html>