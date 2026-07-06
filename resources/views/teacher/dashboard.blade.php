<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: #0a0e1a;
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image: 
                radial-gradient(ellipse at 10% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(6, 182, 212, 0.05) 0%, transparent 60%);
            background-attachment: fixed;
            position: relative;
        }

        /* ===== ANIMATED BACKGROUND ===== */
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

        /* ===== GLASS CARD ===== */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 28px;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.02) inset;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .glass-card:hover {
            border-color: rgba(255, 255, 255, 0.12);
            box-shadow: 
                0 12px 48px rgba(0, 0, 0, 0.6),
                0 0 40px rgba(99, 102, 241, 0.05),
                0 0 0 1px rgba(255, 255, 255, 0.04) inset;
            transform: translateY(-2px);
        }

        /* ===== DASHBOARD LAYOUT ===== */
        .dashboard {
            max-width: 1400px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== HEADER ===== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 36px;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
        }

        .header-title h1 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #f1f5f9 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-title p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
            font-weight: 400;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 8px 16px 8px 12px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }

        .user-badge:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(255, 255, 255, 0.12);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(99, 102, 241, 0.3);
        }

        .user-info .name {
            font-size: 14px;
            font-weight: 600;
            color: #f1f5f9;
        }

        .user-info .email {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.3);
        }

        .logout-btn {
            padding: 8px 20px;
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.15);
            border-radius: 100px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.3);
            transform: scale(1.02);
        }

        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
            padding: 0 4px;
        }

        .stat-card {
            padding: 22px 24px;
            text-align: left;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            font-size: 28px;
            margin-bottom: 10px;
            display: block;
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255, 255, 255, 0.3);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #f1f5f9;
            letter-spacing: -0.5px;
        }

        .stat-value .highlight {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.25);
            margin-top: 4px;
        }

        /* ===== MAIN CONTENT ===== */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            padding: 0 4px;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== DETAILS CARD ===== */
        .details-card {
            padding: 28px 32px;
        }

        .details-card .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
        }

        .detail-value {
            font-size: 13px;
            font-weight: 500;
            color: #f1f5f9;
        }

        .badge {
            display: inline-block;
            padding: 2px 14px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .tag-group {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .tag {
            display: inline-block;
            padding: 3px 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 100px;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.2s ease;
        }

        .tag:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #f1f5f9;
        }

        /* ===== SCHEDULE CARD ===== */
        .schedule-card {
            padding: 28px 32px;
        }

        .schedule-card .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .schedule-card .card-title .count {
            font-size: 12px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.04);
            padding: 2px 12px;
            border-radius: 100px;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }

        .schedule-table th {
            text-align: left;
            padding: 10px 12px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255, 255, 255, 0.25);
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .schedule-table td {
            padding: 10px 12px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            transition: background 0.2s ease;
        }

        .schedule-table tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        .schedule-table td strong {
            color: #f1f5f9;
            font-weight: 500;
        }

        .schedule-table .subject-badge {
            display: inline-block;
            padding: 2px 12px;
            background: rgba(99, 102, 241, 0.12);
            color: #a5b4fc;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: rgba(255, 255, 255, 0.2);
        }

        .empty-state .empty-icon {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header {
                padding: 20px 24px;
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .header-right {
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .details-card,
            .schedule-card {
                padding: 20px 24px;
            }

            .header-title h1 {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-value {
                font-size: 22px;
            }

            .user-badge {
                flex-wrap: wrap;
            }

            .schedule-table {
                font-size: 12px;
            }

            .schedule-table th,
            .schedule-table td {
                padding: 8px 8px;
            }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* ===== SELECTION ===== */
        ::selection {
            background: rgba(99, 102, 241, 0.3);
            color: #f1f5f9;
        }

        /* ===== QUICK ACTION BUTTONS ===== */
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.25);
        }

        .action-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
        }

        .action-btn-secondary {
            background: rgba(255, 255, 255, 0.04);
            color: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .action-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #f1f5f9;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

<div class="dashboard">

    <!-- ===== HEADER ===== -->
    <div class="glass-card header">
        <div class="header-left">
            <div class="logo-icon">📚</div>
            <div class="header-title">
                <h1>Teacher Dashboard</h1>
                <p>Manage your schedule and availability</p>
            </div>
        </div>
        <div class="header-right">
            <div class="user-badge">
                <div class="avatar">{{ strtoupper(substr($teacher->name, 0, 2)) }}</div>
                <div class="user-info">
                    <div class="name">{{ $teacher->name }}</div>
                    <div class="email">{{ $teacher->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('teacher.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <!-- ===== STATS ===== -->
    <div class="stats-grid">
        <div class="glass-card stat-card">
            <span class="stat-icon">📖</span>
            <div class="stat-label">Subject</div>
            <div class="stat-value">{{ ucfirst($teacher->subject) }}</div>
        </div>
        <div class="glass-card stat-card">
            <span class="stat-icon">🏫</span>
            <div class="stat-label">Grade</div>
            <div class="stat-value">{{ $teacher->grade }}</div>
        </div>
        <div class="glass-card stat-card">
            <span class="stat-icon">⭐</span>
            <div class="stat-label">Priority</div>
            <div class="stat-value">
                <span class="badge badge-{{ $teacher->priority }}">
                    {{ ucfirst($teacher->priority) }}
                </span>
            </div>
        </div>
        <div class="glass-card stat-card">
            <span class="stat-icon">📅</span>
            <div class="stat-label">Available Days</div>
            <div class="stat-value">
                <span class="highlight">
                    @if(is_array($teacher->days) || is_object($teacher->days))
                        {{ count($teacher->days) }}
                    @else
                        0
                    @endif
                </span>
            </div>
            <div class="stat-sub">Days available per week</div>
        </div>
    </div>

    <!-- ===== CONTENT GRID ===== -->
    <div class="content-grid">

        <!-- ===== DETAILS CARD ===== -->
        <div class="glass-card details-card">
            <div class="card-title">
                👤 Profile Details
                <span style="margin-left: auto; font-size: 12px; color: rgba(255,255,255,0.2);">ID: #{{ $teacher->id }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Full Name</span>
                <span class="detail-value">{{ $teacher->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ $teacher->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Subject</span>
                <span class="detail-value">{{ ucfirst($teacher->subject) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Grade</span>
                <span class="detail-value">{{ $teacher->grade }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Priority</span>
                <span class="detail-value">
                    <span class="badge badge-{{ $teacher->priority }}">
                        {{ ucfirst($teacher->priority) }}
                    </span>
                </span>
            </div>

            <div class="detail-row" style="flex-direction: column; gap: 10px; align-items: stretch; padding-bottom: 0;">
                <span class="detail-label">Available Days</span>
                <div class="tag-group">
                    @if(is_array($teacher->days) || is_object($teacher->days))
                        @foreach($teacher->days as $day)
                            <span class="tag">{{ $day }}</span>
                        @endforeach
                    @else
                        <span class="tag">{{ $teacher->days }}</span>
                    @endif
                </div>
            </div>

            <div class="detail-row" style="flex-direction: column; gap: 10px; align-items: stretch;">
                <span class="detail-label">Available Periods</span>
                <div class="tag-group">
                    @if(is_array($teacher->periods) || is_object($teacher->periods))
                        @foreach($teacher->periods as $period)
                            <span class="tag">P{{ $period }}</span>
                        @endforeach
                    @else
                        <span class="tag">{{ $teacher->periods }}</span>
                    @endif
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('teachers.index') }}" class="action-btn action-btn-secondary">
                    ← Back to Teachers
                </a>
            </div>
        </div>

        <!-- ===== SCHEDULE CARD ===== -->
        <div class="glass-card schedule-card">
            <div class="card-title">
                📅 My Schedule
                <span class="count">{{ $teacher->schedules->count() }} classes</span>
            </div>

            @if($teacher->schedules && $teacher->schedules->count() > 0)
            <div style="overflow-x: auto;">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Period</th>
                            <th>Subject</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teacher->schedules as $schedule)
                        <tr>
                            <td><strong>{{ $schedule->day }}</strong></td>
                            <td>P{{ $schedule->period_id }}</td>
                            <td><span class="subject-badge">{{ ucfirst($schedule->subject) }}</span></td>
                            <td>{{ $schedule->grade }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <p>No schedule assigned yet</p>
                <p style="font-size: 12px; color: rgba(255,255,255,0.15); margin-top: 4px;">Contact admin to create your schedule</p>
            </div>
            @endif
        </div>

    </div>

</div>
<!-- ===== AVAILABILITY TOGGLE ===== -->
<div class="glass-card" style="padding: 24px 32px; margin-bottom: 28px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h3 style="font-size: 16px; font-weight: 600; color: #f1f5f9;">
                📌 Availability Status
            </h3>
            <p style="font-size: 13px; color: rgba(255,255,255,0.35); margin-top: 4px;">
                @if($teacher->is_available)
                    <span style="color: #6ee7b7;">✅ You are marked as available</span>
                @else
                    <span style="color: #fca5a5;">❌ You are marked as unavailable ({{ $teacher->unavailable_reason ?? 'No reason provided' }})</span>
                @endif
            </p>
        </div>
        <div>
            @if($teacher->is_available)
                <button onclick="showUnavailableForm()" class="action-btn action-btn-secondary" style="background: rgba(239, 68, 68, 0.12); color: #fca5a5; border-color: rgba(239, 68, 68, 0.2);">
                    ❌ Mark as Unavailable
                </button>
            @else
                <form method="POST" action="{{ route('teacher.mark-available') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="action-btn action-btn-primary">
                        ✅ Mark as Available
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Unavailable Form (hidden by default) -->
    <div id="unavailableForm" style="display: none; margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.06);">
        <form method="POST" action="{{ route('teacher.mark-unavailable') }}">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label style="color: rgba(255,255,255,0.5); font-size: 13px; display: block; margin-bottom: 6px;">Reason for absence</label>
                    <input type="text" name="reason" placeholder="e.g., Sick leave, Personal work" style="width: 100%; padding: 10px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; color: white; font-size: 14px;">
                </div>
                <div style="display: flex; align-items: flex-end; gap: 10px;">
                    <button type="submit" class="action-btn action-btn-primary" style="background: linear-gradient(135deg, #ef4444, #b91c1c);">
                        Confirm Unavailable
                    </button>
                    <button type="button" onclick="hideUnavailableForm()" class="action-btn action-btn-secondary">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function showUnavailableForm() {
        document.getElementById('unavailableForm').style.display = 'block';
    }
    function hideUnavailableForm() {
        document.getElementById('unavailableForm').style.display = 'none';
    }
</script>

</body>
</html>