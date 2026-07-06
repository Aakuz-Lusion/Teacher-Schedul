<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #080c18;
            background-image: 
                radial-gradient(ellipse at 10% 20%, rgba(59, 130, 246, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 50%);
            padding: 20px;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }
        h1 {
            color: #f1f5f9;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .subtitle {
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 30px;
        }
        label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            color: white;
            font-size: 14px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #60a5fa;
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.1);
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #3b82f6, #7c3aed);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
        }
        .error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.2);
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
    </style>
</head>
<body>
    <div class="login-box">
        <h1>👨‍🏫 Teacher Login</h1>
        <p class="subtitle">Sign in to view your schedule</p>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('teacher.login.post') }}">
            @csrf
            <label>Email Address</label>
            <input type="email" name="email" placeholder="teacher@school.com" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <button type="submit">Login</button>
        </form>

        <div class="footer">
            <p>Demo Teachers:</p>
            <p style="font-size: 11px; margin-top: 5px;">
                sharma@school.com | gurung@school.com | thapa@school.com
            </p>
            <p style="font-size: 11px; color: rgba(255,255,255,0.15);">
                Password: <strong style="color: rgba(255,255,255,0.2);">password</strong>
            </p>
        </div>
    </div>
</body>
</html> 