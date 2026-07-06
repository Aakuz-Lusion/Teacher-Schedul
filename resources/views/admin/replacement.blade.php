<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Replacement</title>
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
            max-width: 600px;
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
        .info-box { background: rgba(99,102,241,0.06); border: 1px solid rgba(99,102,241,0.1); border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; }
        .info-box label { color: rgba(255,255,255,0.3); font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-box .value { color: #f1f5f9; font-size: 16px; font-weight: 500; margin-top: 2px; }
        label { display: block; color: rgba(255,255,255,0.5); font-size: 13px; margin-bottom: 6px; }
        select { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; color: white; font-size: 14px; margin-bottom: 16px; transition: all 0.3s ease; font-family: 'Inter', sans-serif; }
        select:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99,102,241,0.1); }
        select option { background: #1a1a2e; color: white; padding: 8px; }
        input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; color: white; font-size: 14px; margin-bottom: 16px; transition: all 0.3s ease; }
        input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99,102,241,0.1); }
        .btn { padding: 12px 24px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-block; font-family: 'Inter', sans-serif; width: 100%; text-align: center; }
        .btn-primary { background: linear-gradient(135deg, #22c55e, #15803d); color: white; box-shadow: 0 4px 16px rgba(34,197,94,0.25); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(34,197,94,0.35); }
        .btn-secondary { background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.5); border: 1px solid rgba(255,255,255,0.06); margin-top: 12px; }
        .btn-secondary:hover { background: rgba(255,255,255,0.08); color: #f1f5f9; }
        .back-link { color: rgba(255,255,255,0.3); text-decoration: none; display: inline-block; margin-bottom: 20px; transition: color 0.3s ease; }
        .back-link:hover { color: rgba(255,255,255,0.6); }
        .badge-unavailable { background: rgba(239, 68, 68, 0.12); color: #fca5a5; padding: 2px 12px; border-radius: 100px; font-size: 12px; }
        .no-teachers { text-align: center; padding: 20px; color: rgba(255,255,255,0.3); }
    </style>
</head>
<body>
<div class="glass">
    <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>🔄 Assign Replacement</h1>
    <p class="subtitle">Replace <span style="color: #fca5a5;">{{ $unavailableTeacher->name }}</span></p>

    <div class="info-box">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
                <label>Subject</label>
                <div class="value">{{ ucfirst($unavailableTeacher->subject) }}</div>
            </div>
            <div>
               