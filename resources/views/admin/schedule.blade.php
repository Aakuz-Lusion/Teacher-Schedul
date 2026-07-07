<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #0a0e1a;
        color: #f1f5f9;
        padding: 12px;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(99, 102, 241, .12), transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(139, 92, 246, .10), transparent 50%);
    }

    .container {
        max-width: 1900px;
        margin: auto;
    }

    .glass {
        background: rgba(255, 255, 255, .03);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, .06);
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .35);
    }

    /* ================= HEADER ================= */

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 16px;
    }

    h1 {
        font-size: 24px;
        font-weight: 700;
        background: linear-gradient(135deg, #fff, #9ca3af);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .subtitle {
        font-size: 12px;
        color: #94a3b8;
    }

    /* ================= BUTTONS ================= */

    .btn {
        padding: 8px 18px;
        border: none;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: .3s;
    }

    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, .05);
        color: #d1d5db;
        border: 1px solid rgba(255, 255, 255, .08);
    }

    /* ================= NAV ================= */

    .nav-links {
        display: flex;
        gap: 8px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .nav-links a {
        text-decoration: none;
        color: #9ca3af;
        padding: 5px 12px;
        font-size: 11px;
        border-radius: 20px;
        transition: .25s;
    }

    .nav-links a:hover {
        background: rgba(255, 255, 255, .06);
        color: white;
    }

    .nav-links a.active {
        background: #4f46e5;
        color: white;
    }

    /* ================= ALERTS ================= */

    .flash {
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 10px;
        font-size: 12px;
    }

    .flash-success {
        background: rgba(34, 197, 94, .12);
        color: #6ee7b7;
    }

    .flash-error {
        background: rgba(239, 68, 68, .12);
        color: #fca5a5;
    }

    /* ================= GRID ================= */

    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    /* ================= CARD ================= */

    .grade-card {
        background: rgba(255, 255, 255, .025);
        border: 1px solid rgba(255, 255, 255, .06);
        border-radius: 12px;
        padding: 8px;
        transition: .25s;
    }

    .grade-card:hover {
        border-color: #6366f1;
        transform: translateY(-2px);
    }

    .grade-card h3 {
        text-align: center;
        font-size: 13px;
        margin-bottom: 8px;
        color: #fff;
    }

    /* ================= TABLE ================= */

    .schedule-row {
        display: grid;
        grid-template-columns: 28px repeat(6, 1fr);
        gap: 2px;
        align-items: center;
        padding: 2px 0;
    }

    .schedule-row-header {
        font-size: 8px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
        padding-bottom: 4px;
        margin-bottom: 3px;
    }

    .period-label {
        font-size: 8px;
        font-weight: 700;
        color: #94a3b8;
    }

    /* ================= CELLS ================= */

    .schedule-cell {
        min-height: 32px;
        padding: 2px;
        border-radius: 5px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .cell-assigned {
        background: rgba(79, 70, 229, .18);
        border: 1px solid rgba(99, 102, 241, .30);
    }

    .cell-unassigned {
        background: rgba(255, 255, 255, .03);
        border: 1px dashed rgba(255, 255, 255, .06);
    }

    /* ================= SUBJECT ================= */

    .subject-badge {
        display: inline-block;
        padding: 1px 4px;
        border-radius: 8px;
        font-size: 7px;
        font-weight: 700;
        background: #4f46e5;
        color: white;
        margin-bottom: 2px;
    }

    /* ================= TEACHER ================= */

    .teacher-name {
        font-size: 7px !important;
        color: #f8fafc;
        line-height: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100%;
    }

    /* ================= RESPONSIVE ================= */

    @media(max-width:1500px) {

        .schedule-grid {
            grid-template-columns: repeat(3, 1fr);
        }

    }

    @media(max-width:1100px) {

        .schedule-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media(max-width:700px) {

        .schedule-grid {
            grid-template-columns: 1fr;
        }

        .glass {
            padding: 10px;
        }

        .schedule-row {
            grid-template-columns: 24px repeat(6, 1fr);
        }

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
            $grades = ['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade
            4-B', 'Grade 5-A', 'Grade 5-B'];
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
                        @endphp
                        <div
                            class="schedule-cell {{ $entry && $entry->teacher_name != '—' ? 'cell-assigned' : 'cell-unassigned' }}">
                            @if($entry && $entry->teacher_name != '—')
                            <div class="subject-badge">{{ ucfirst($entry->subject) }}</div>
                            <div class="teacher-name" style="font-size: 9px; margin-top: 2px;">
                                {{ $entry->teacher_name }}</div>
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

            <div
                style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.06); display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; color: rgba(255,255,255,0.3); font-size: 12px;">
                <span>Total Schedules: <strong
                        style="color: #f1f5f9;">{{ \App\Models\Schedule::count() }}</strong></span>
                <span>Assigned: <strong
                        style="color: #6ee7b7;">{{ \App\Models\Schedule::where('teacher_name', '!=', '—')->count() }}</strong></span>
                <span>Unassigned: <strong
                        style="color: #fca5a5;">{{ \App\Models\Schedule::where('teacher_name', '—')->count() }}</strong></span>
            </div>
        </div>
    </div>
</body>

</html>