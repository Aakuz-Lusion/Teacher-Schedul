<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
            background: #0a0e1a;
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image: radial-gradient(ellipse at 10% 20%, rgba(99, 102, 241, 0.12) 0%, transparent 50%);
        }
        .glass {
            max-width: 500px;
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }
        h1 { font-size: 26px; font-weight: 800; margin-bottom: 6px; background: linear-gradient(135deg, #f1f5f9, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .subtitle { color: rgba(255,255,255,0.35); font-size: 14px; margin-bottom: 28px; }
        label { display: block; color: rgba(255,255,255,0.5); font-size: 13px; margin-bottom: 6px; }
        input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; color: white; font-size: 14px; margin-bottom: 16px; transition: all 0.3s ease; }
        input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99,102,241,0.1); }
        .btn { padding: 12px 24px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-block; font-family: 'Inter', sans-serif; width: 100%; text-align: center; }
        .btn-primary { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; box-shadow: 0 4px 16px rgba(99,102,241,0.25); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.35); }
        .btn-secondary { background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.5); border: 1px solid rgba(255,255,255,0.06); margin-top: 12px; }
        .btn-secondary:hover { background: rgba(255,255,255,0.08); color: #f1f5f9; }
        .flash { padding: 14px 20px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; }
        .flash-success { background: rgba(34, 197, 94, 0.12); border: 1px solid rgba(34,197,94,0.15); color: #6ee7b7; }
        .flash-error { background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239,68,68,0.15); color: #fca5a5; }
        .teacher-name { color: #f1f5f9; font-weight: 600; }
        .back-link { color: rgba(255,255,255,0.3); text-decoration: none; display: inline-block; margin-bottom: 20px; transition: color 0.3s ease; }
        .back-link:hover { color: rgba(255,255,255,0.6); }
    </style>
</head>
<body>
<div class="glass">
    <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>🔑 Change Password</h1>
    <p class="subtitle">Update password for <span class="teacher-name">{{ $teacher->name }}</span></p>

    @if(session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="flash flash-error">
            @foreach($errors->all() as $error) • {{ $error }}<br> @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.update-password', $teacher->id) }}">
        @csrf
        <label>New Password</label>
        <input type="password" name="password" placeholder="Min 6 characters" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>

        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
</div>
</body>
</html>