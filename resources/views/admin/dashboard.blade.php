<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
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
            transition: all 0.3s ease;
        }
        .glass:hover {
            border-color: rgba(255, 255, 255, 0.10);
        }
        .header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 28px; }
        h1 { font-size: 28px; font-weight: 800; background: linear-gradient(135deg, #f1f5f9, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .stat-card { padding: 24px; text-align: center; }
        .stat-number { font-size: 32px; font-weight: 800; background: linear-gradient(135deg, #6366f1, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: rgba(255,255,255,0.3); margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { text-align: left; padding: 12px 14px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: rgba(255,255,255,0.3); border-bottom: 1px solid rgba(255,255,255,0.06); }
        td { padding: 12px 14px; border-bottom: 1px solid rgba(255,255,255,0.03); color: rgba(255,255,255,0.7); font-size: 13px; }
        tr:hover td { background: rgba(255,255,255,0.02); }
        .badge { display: inline-block; padding: 2px 14px; border-radius: 100px; font-size: 11px; font-weight: 600; }
        .badge-available { background: rgba(34, 197, 94, 0.15); color: #6ee7b7; }
        .badge-unavailable { background: rgba(239, 68, 68, 0.15); color: #fca5a5; }
        .badge-high { background: rgba(239, 68, 68, 0.15); color: #fca5a5; }
        .badge-medium { background: rgba(251, 191, 36, 0.15); color: #fcd34d; }
        .badge-low { background: rgba(34, 197, 94, 0.15); color: #6ee7b7; }
        .btn { padding: 8px 18px; border: none; border-radius: 100px; font-size: 12px; font-weight: 500; cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-block; font-family: 'Inter', sans-serif; }
        .btn-primary { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; box-shadow: 0 4px 16px rgba(99,102,241,0.25); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.35); }
        .btn-danger { background: rgba(239, 68, 68, 0.12); color: #fca5a5; border: 1px solid rgba(239,68,68,0.15); }
        .btn-danger:hover { background: rgba(239, 68, 68, 0.2); }
        .btn-success { background: rgba(34, 197, 94, 0.12); color: #6ee7b7; border: 1px solid rgba(34,197,94,0.15); }
        .btn-success:hover { background: rgba(34, 197, 94, 0.2); }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 16px; }
        .flash { padding: 14px 20px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; }
        .flash-success { background: rgba(34, 197, 94, 0.12); border: 1px solid rgba(34,197,94,0.15); color: #6ee7b7; }
        .flash-info { background: rgba(99, 102, 241, 0.12); border: 1px solid rgba(99,102,241,0.15); color: #a5b4fc; }
        .section-title { font-size: 18px; font-weight: 600; margin-bottom: 16px; color: #f1f5f9; }
        .badge-status { display: inline-block; padding: 4px 14px; border-radius: 100px; font-size: 11px; font-weight: 500; }
        .badge-available { background: rgba(34, 197, 94, 0.12); color: #6ee7b7; }
        .badge-unavailable { background: rgba(239, 68, 68, 0.12); color: #fca5a5; }
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .glass { padding: 20px; }
            table { font-size: 12px; }
            th, td { padding: 8px 10px; }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <h1>👑 Admin Dashboard</h1>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ route('teachers.index') }}" class="btn btn-primary">View All Teachers</a>
            <a href="{{ route('teachers.create') }}" class="btn btn-primary">+ Add Teacher</a>
            <a href="{{ route('admin.generate-schedule') }}" class="btn btn-success">🔄 Generate Schedule</a>
        </div>
    </div>

    @if(session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="flash flash-info">{{ session('info') }}</div>
    @endif

    <div class="stats-grid">
        <div class="glass stat-card">
            <div class="stat-number">{{ $teachers->count() }}</div>
            <div class="stat-label">Total Teachers</div>
        </div>
        <div class="glass stat-card">
            <div class="stat-number" style="background: linear-gradient(135deg, #34d399, #22c55e); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $availableTeachers }}</div>
            <div class="stat-label">✅ Available Today</div>
        </div>
        <div class="glass stat-card">
            <div class="stat-number" style="background: linear-gradient(135deg, #f87171, #ef4444); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $unavailableTeachers }}</div>
            <div class="stat-label">❌ Unavailable Today</div>
        </div>
        <div class="glass stat-card">
            <div class="stat-number" style="background: linear-gradient(135deg, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $totalSchedules }}</div>
            <div class="stat-label">📅 Total Schedules</div>
        </div>
    </div>

    <div class="glass">
        <div class="section-title">👨‍🏫 All Teachers</div>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $index => $teacher)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $teacher->name }}</strong></td>
                        <td>{{ ucfirst($teacher->subject) }}</td>
                        <td>{{ $teacher->grade }}</td>
                        <td><span class="badge badge-{{ $teacher->priority }}">{{ ucfirst($teacher->priority) }}</span></td>
                        <td>
                            @if($teacher->is_available)
                                <span class="badge-status badge-available">✅ Available</span>
                            @else
                                <span class="badge-status badge-unavailable">❌ Unavailable</span>
                            @endif
                            @if(!$teacher->is_available && $teacher->unavailable_reason)
                                <br><small style="color: rgba(255,255,255,0.3);">{{ $teacher->unavailable_reason }}</small>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                <a href="{{ route('admin.change-password', $teacher->id) }}" class="btn btn-primary" style="font-size: 11px; padding: 4px 12px;">🔑 Change Password</a>
                                @if(!$teacher->is_available)
                                    <a href="{{ route('admin.replacement', $teacher->id) }}" class="btn btn-success" style="font-size: 11px; padding: 4px 12px;">🔄 Replace</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>