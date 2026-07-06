<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #0a0e1a;
            color: #f1f5f9;
            padding: 20px;
            background-image: 
                radial-gradient(ellipse at 10% 20%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.10) 0%, transparent 50%);
        }
        .container { max-width: 1400px; margin: 0 auto; }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            padding: 28px 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }
        h1 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #f1f5f9, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .subtitle { color: rgba(255,255,255,0.35); font-size: 14px; margin-top: 4px; }
        .btn {
            padding: 10px 24px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 4px 16px rgba(99,102,241,0.25);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99,102,241,0.35);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.04);
            color: rgba(255,255,255,0.5);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.08);
            color: #f1f5f9;
        }
        .nav-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .nav-links a {
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 100px;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        .nav-links a:hover {
            background: rgba(255,255,255,0.05);
            color: #f1f5f9;
        }
        .nav-links a.active {
            background: rgba(99,102,241,0.12);
            color: #a5b4fc;
        }
        .flash {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .flash-success {
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34,197,94,0.15);
            color: #6ee7b7;
        }
        .flash-error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239,68,68,0.15);
            color: #fca5a5;
        }
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .grade-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            padding: 20px;
        }
        .grade-card h3 {
            color: #f1f5f9;
            margin-bottom: 16px;
            font-size: 16px;
            font-weight: 600;
        }
        .schedule-row {
            display: grid;
            grid-template-columns: 50px 1fr 1fr 1fr 1fr 1fr 1fr;
            gap: 4px;
            padding: 4px 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            font-size: 12px;
            align-items: center;
        }
        .schedule-row-header {
            color: rgba(255,255,255,0.3);
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .schedule-cell {
            padding: 4px 6px;
            border-radius: 6px;
            text-align: center;
            font-size: 11px;
        }
        .cell-assigned {
            background: rgba(99,102,241,0.08);
            color: #a5b4fc;
        }
        .cell-unassigned {
            background: rgba(239,68,68,0.05);
            color: rgba(255,255,255,0.2);
        }
        .period-label {
            color: rgba(255,255,255,0.4);
            font-weight: 500;
            font-size: 10px;
        }
        .teacher-name {
            font-weight: 500;
            color: #f1f5f9;
        }
        .subject-badge {
            display: inline-block;
            padding: 2px 10px;
            background: rgba(99,102,241,0.12);
            border-radius: 100px;
            font-size: 10px;
            color: #a5b4fc;
        }
        @media (max-width: 768px) {
            .schedule-row {
                grid-template-columns: 40px 1fr 1fr;
                font-size: 10px;
            }
            .schedule-row-header {
                display: none;
            }
            .glass { padding: 16px; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="glass">
        <div class="nav-links">
            <a href="{{ route('teachers.index') }}">👨‍🏫 Teachers</a>
            <a href="{{ route('admin.dashboard') }}">👑 Admin Dashboard</a>
            <a href="{{ route('admin.schedule') }}" class="active">📅 Schedule</a>
        </div>

        <div class="header">
            <div>
                <h1>📅 Timetable</h1>
                <p class="subtitle">Complete school timetable</p>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('admin.generate-schedule') }}" class="btn btn-primary">🔄 Generate Schedule</a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Back</a>
            </div>
        </div>

        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">{{ session('error') }}</div>
        @endif

        @php
            $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $periods = [1, 2, 4, 5, 7, 8, 10];
            $grades = ['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade 4-B', 'Grade 5-A', 'Grade 5-B'];
            $allSchedules = \App\Models\Schedule::all()->groupBy('grade');
        @endphp

        <div class="schedule-grid">
            @foreach($grades as $grade)
                <div class="grade-card">
                    <h3>{{ $grade }}</h3>
                    <div class="schedule-row schedule-row-header">
                        <span>P</span>
                        @foreach($days as $day)
                            <span>{{ substr($day, 0, 3) }}</span>
                        @endforeach
                    </div>
                    
                    @foreach($periods as $period)
                        <div class="schedule-row">
                            <span class="period-label">P{{ $period }}</span>
                            @foreach($days as $day)
                                @php
                                    $schedule = $allSchedules[$grade] ?? collect();
                                    $entry = $schedule->where('day', $day)->where('period_id', $period)->first();
                                    dd($allSchedules);
                                @endphp
                                <div class="schedule-cell {{ $entry && $entry->teacher_name != '—' ? 'cell-assigned' : 'cell-unassigned' }}">
                                    @if($entry && $entry->teacher_name != '—')
                                        <div class="subject-badge">{{ ucfirst($entry->subject) }}</div>
                                        <div class="teacher-name" style="font-size: 9px; margin-top: 2px;">{{ $entry->teacher_name }}</div>
                                    @else
                                        <span style="font-size: 10px;">—</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.06); display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; color: rgba(255,255,255,0.3); font-size: 12px;">
            <span>Total Schedules: <strong style="color: #f1f5f9;">{{ \App\Models\Schedule::count() }}</strong></span>
            <span>Assigned: <strong style="color: #6ee7b7;">{{ \App\Models\Schedule::where('teacher_name', '!=', '—')->count() }}</strong></span>
            <span>Unassigned: <strong style="color: #fca5a5;">{{ \App\Models\Schedule::where('teacher_name', '—')->count() }}</strong></span>
        </div>
    </div>
</div>
</body>
</html>