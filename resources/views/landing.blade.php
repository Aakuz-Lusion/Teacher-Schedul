<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Scheduler</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
            background: #0a0e1a;
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image:
                radial-gradient(ellipse at 10% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 50%);
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 30% 40%, rgba(99, 102, 241, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 70% 60%, rgba(139, 92, 246, 0.03) 0%, transparent 30%);
            pointer-events: none;
            z-index: 0;
            animation: floatBg 20s ease-in-out infinite;
        }
        @keyframes floatBg {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -20px) rotate(2deg); }
            66% { transform: translate(-20px, 30px) rotate(-2deg); }
        }

        .landing-container {
            max-width: 1100px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 32px;
            padding: 56px 48px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .logo-icon {
            font-size: 72px;
            display: block;
            margin-bottom: 16px;
        }
        h1 {
            font-size: 48px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #f1f5f9 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 12px;
        }
        .tagline {
            font-size: 18px;
            color: rgba(255,255,255,0.35);
            margin-bottom: 48px;
            font-weight: 400;
        }

        .portal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            max-width: 600px;
            margin: 0 auto;
        }
        .portal-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 32px 24px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #f1f5f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }
        .portal-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }
        .portal-card .icon {
            font-size: 48px;
        }
        .portal-card .label {
            font-size: 20px;
            font-weight: 600;
        }
        .portal-card .desc {
            font-size: 14px;
            color: rgba(255,255,255,0.3);
        }
        .portal-card .badge {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-admin {
            background: rgba(99, 102, 241, 0.15);
            color: #a5b4fc;
        }
        .badge-teacher {
            background: rgba(34, 197, 94, 0.12);
            color: #6ee7b7;
        }

        .footer {
            margin-top: 40px;
            color: rgba(255,255,255,0.15);
            font-size: 13px;
        }
        .footer a {
            color: rgba(255,255,255,0.25);
            text-decoration: none;
        }
        .footer a:hover {
            color: rgba(255,255,255,0.4);
        }

        @media (max-width: 640px) {
            .glass-card { padding: 32px 24px; }
            h1 { font-size: 32px; }
            .portal-grid { grid-template-columns: 1fr; max-width: 320px; }
            .logo-icon { font-size: 48px; }
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <div class="glass-card">
            <span class="logo-icon">📚</span>
            <h1>Teacher Scheduler</h1>
            <p class="tagline">Efficiently manage teachers, schedules, and replacements</p>

            <div class="portal-grid">
                <a href="{{ route('admin.login') }}" class="portal-card">
                    <span class="icon">👑</span>
                    <span class="label">Admin Login</span>
                    <span class="desc">Manage teachers, generate schedules</span>
                    <span class="badge badge-admin">Admin Access</span>
                </a>
                <a href="{{ route('teacher.login') }}" class="portal-card">
                    <span class="icon">👨‍🏫</span>
                    <span class="label">Teacher Login</span>
                    <span class="desc">View your schedule & availability</span>
                    <span class="badge badge-teacher">Teacher Access</span>
                </a>
            </div>

            <div class="footer">
                <p>© 2026 Teacher Scheduler • Built with Laravel</p>
            </div>
        </div>
    </div>
</body>
</html>