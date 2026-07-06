<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers List</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #0a0e1a;
            color: #f1f5f9;
            min-height: 100vh;
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
        .subtitle {
            color: rgba(255, 255, 255, 0.35);
            font-size: 14px;
            margin-top: 4px;
        }
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th {
            text-align: left;
            padding: 14px 16px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,255,0.3);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-weight: 600;
        }
        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            color: rgba(255,255,255,0.7);
            font-size: 13px;
        }
        tr:hover td {
            background: rgba(255,255,255,0.02);
        }
        .badge {
            display: inline-block;
            padding: 3px 14px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-high {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }
        .badge-medium {
            background: rgba(251, 191, 36, 0.15);
            color: #fcd34d;
        }
        .badge-low {
            background: rgba(34, 197, 94, 0.15);
            color: #6ee7b7;
        }
        .badge-status {
            display: inline-block;
            padding: 3px 14px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 500;
        }
        .badge-available {
            background: rgba(34, 197, 94, 0.12);
            color: #6ee7b7;
        }
        .badge-unavailable {
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
        }
        .tag {
            display: inline-block;
            padding: 2px 10px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 100px;
            font-size: 11px;
            color: rgba(255,255,255,0.5);
            margin: 2px;
        }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
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
        .stats-bar {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }
        .stats-bar span {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
        }
        .stats-bar strong {
            color: #f1f5f9;
        }
        .stats-bar .available-count {
            color: #6ee7b7;
        }
        .stats-bar .unavailable-count {
            color: #fca5a5;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: rgba(255,255,255,0.3);
        }
        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .empty-state a {
            color: #6366f1;
            text-decoration: none;
        }
        .empty-state a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .glass { padding: 16px; }
            table { font-size: 12px; }
            th, td { padding: 8px 10px; }
            .header { flex-direction: column; align-items: stretch; }
            .stats-bar { gap: 12px; }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="glass">
        <!-- Navigation -->
        <div class="nav-links">
            <a href="{{ route('teachers.index') }}" class="active">👨‍🏫 Teachers</a>
            <a href="{{ route('admin.dashboard') }}">👑 Admin Dashboard</a>
            <a href="{{ route('teacher.login') }}">🔐 Teacher Login</a>
        </div>

        <!-- Header -->
        <div class="header">
            <div>
                <h1>👨‍🏫 Teachers List</h1>
                <p class="subtitle">Manage all teachers and their availability</p>
            </div>
            <a href="{{ route('teachers.create') }}" class="btn btn-primary">+ Add Teacher</a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        <!-- Stats -->
        <div class="stats-bar">
            <span>Total: <strong>{{ $teachers->count() }}</strong></span>
            <span>✅ Available: <strong class="available-count">{{ $teachers->where('is_available', true)->count() }}</strong></span>
            <span>❌ Unavailable: <strong class="unavailable-count">{{ $teachers->where('is_available', false)->count() }}</strong></span>
        </div>

        <!-- Table -->
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
                        <th>Days</th>
                        <th>Periods</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $index => $teacher)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $teacher->name }}</strong></td>
                        <td>{{ ucfirst($teacher->subject) }}</td>
                        <td>{{ $teacher->grade }}</td>
                        <td>
                            <span class="badge badge-{{ $teacher->priority }}">
                                {{ ucfirst($teacher->priority) }}
                            </span>
                        </td>
                        <td>
                            @if($teacher->is_available)
                                <span class="badge-status badge-available">✅ Available</span>
                            @else
                                <span class="badge-status badge-unavailable">❌ Unavailable</span>
                                @if($teacher->unavailable_reason)
                                    <br><small style="color: rgba(255,255,255,0.3); font-size: 10px;">{{ $teacher->unavailable_reason }}</small>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if(is_array($teacher->days) || is_object($teacher->days))
                                @foreach($teacher->days as $day)
                                    <span class="tag">{{ $day }}</span>
                                @endforeach
                            @else
                                <span class="tag">{{ $teacher->days }}</span>
                            @endif
                        </td>
                        <td>
                            @if(is_array($teacher->periods) || is_object($teacher->periods))
                                @foreach($teacher->periods as $period)
                                    <span class="tag">P{{ $period }}</span>
                                @endforeach
                            @else
                                <span class="tag">{{ $teacher->periods }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.change-password', $teacher->id) }}" 
                                   class="btn btn-primary" style="font-size: 11px; padding: 4px 14px; background: linear-gradient(135deg, #6366f1, #8b5cf6);" title="Change Password">
                                    🔑
                                </a>
                                @if(!$teacher->is_available)
                                    <a href="{{ route('admin.replacement', $teacher->id) }}" 
                                       class="btn btn-secondary" style="font-size: 11px; padding: 4px 14px; background: rgba(34,197,94,0.12); color: #6ee7b7; border-color: rgba(34,197,94,0.15);" title="Assign Replacement">
                                        🔄
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="empty-state">
                            <div class="icon">📋</div>
                            <p>No teachers found.</p>
                            <p><a href="{{ route('teachers.create') }}">Add your first teacher</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>