@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')
@section('header', '📚 My Dashboard')
@section('subtitle', 'Welcome back, ' . ($teacher->name ?? 'Teacher') . '!')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
    }
    .stat-card .value {
        font-size: 24px;
        font-weight: 700;
        color: #f1f5f9;
    }
    .stat-card .label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.3);
        margin-top: 4px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .info-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 20px;
    }
    .info-card label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.3);
        display: block;
    }
    .info-card .value {
        font-size: 16px;
        font-weight: 600;
        color: #f1f5f9;
        margin-top: 4px;
    }
    .badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-high { background: rgba(239,68,68,0.15); color: #fca5a5; }
    .badge-medium { background: rgba(251,191,36,0.15); color: #fcd34d; }
    .badge-low { background: rgba(34,197,94,0.15); color: #6ee7b7; }
    .tag {
        display: inline-block;
        padding: 2px 10px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 100px;
        font-size: 12px;
        color: rgba(255,255,255,0.5);
        margin: 2px;
    }
    .schedule-table {
        width: 100%;
        border-collapse: collapse;
    }
    .schedule-table th {
        text-align: left;
        padding: 10px 12px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.3);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        font-weight: 600;
    }
    .schedule-table td {
        padding: 10px 12px;
        border-bottom: 1px solid rgba(255,255,255,0.03);
        color: rgba(255,255,255,0.7);
        font-size: 13px;
    }
    .schedule-table tr:hover td {
        background: rgba(255,255,255,0.02);
    }
    .schedule-table .subject-badge {
        display: inline-block;
        padding: 2px 12px;
        background: rgba(99,102,241,0.12);
        border-radius: 100px;
        font-size: 11px;
        color: #a5b4fc;
    }
    .availability-box {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .availability-box .status-text {
        font-size: 14px;
    }
    .btn-availability {
        padding: 10px 24px;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }
    .btn-available {
        background: rgba(34,197,94,0.12);
        color: #6ee7b7;
        border: 1px solid rgba(34,197,94,0.15);
    }
    .btn-available:hover {
        background: rgba(34,197,94,0.2);
    }
    .btn-unavailable {
        background: rgba(239,68,68,0.12);
        color: #fca5a5;
        border: 1px solid rgba(239,68,68,0.15);
    }
    .btn-unavailable:hover {
        background: rgba(239,68,68,0.2);
    }
    .unavailable-form {
        display: none;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }
    .unavailable-form input {
        padding: 10px 14px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 10px;
        color: white;
        font-size: 14px;
        width: 100%;
        max-width: 300px;
        margin-right: 10px;
    }
    .unavailable-form input:focus {
        outline: none;
        border-color: #6366f1;
    }
    .unavailable-form .btn-confirm {
        padding: 10px 20px;
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }
    .unavailable-form .btn-cancel {
        padding: 10px 20px;
        background: rgba(255,255,255,0.05);
        color: rgba(255,255,255,0.5);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<!-- Availability Section -->
<div class="availability-box">
    <div>
        <div class="status-text">
            <strong>📌 Availability Status</strong><br>
            @if($teacher->is_available)
                <span style="color: #6ee7b7;">✅ You are marked as available</span>
            @else
                <span style="color: #fca5a5;">❌ You are marked as unavailable</span>
                @if($teacher->unavailable_reason)
                    <br><small style="color: rgba(255,255,255,0.3);">Reason: {{ $teacher->unavailable_reason }}</small>
                @endif
            @endif
        </div>
    </div>
    <div>
        @if($teacher->is_available)
            <button onclick="showUnavailableForm()" class="btn-availability btn-unavailable">
                ❌ Mark as Unavailable
            </button>
        @else
            <form method="POST" action="{{ route('teacher.mark-available') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-availability btn-available">
                    ✅ Mark as Available
                </button>
            </form>
        @endif
    </div>
</div>

<!-- Unavailable Form -->
<div class="unavailable-form" id="unavailableForm">
    <form method="POST" action="{{ route('teacher.mark-unavailable') }}">
        @csrf
        <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
            <input type="text" name="reason" placeholder="Reason for absence (e.g., Sick leave, Personal work)">
            <button type="submit" class="btn-confirm">Confirm Unavailable</button>
            <button type="button" onclick="hideUnavailableForm()" class="btn-cancel">Cancel</button>
        </div>
    </form>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="value">{{ ucfirst($teacher->subject) }}</div>
        <div class="label">Subject</div>
    </div>
    <div class="stat-card">
        <div class="value">{{ count($teacher->grades ?? []) }}</div>
        <div class="label">Grades Teaching</div>
    </div>
    <div class="stat-card">
        <div class="value">{{ $teacher->schedules->count() }}</div>
        <div class="label">Total Classes</div>
    </div>
</div>

<!-- Teacher Info -->
<div class="info-grid">
    <div class="info-card">
        <label>Subject</label>
        <div class="value">{{ ucfirst($teacher->subject) }}</div>
    </div>
    <div class="info-card">
        <label>Grades</label>
        <div class="value">
            @if(is_array($teacher->grades) || is_object($teacher->grades))
                @foreach($teacher->grades as $grade)
                    <span class="tag">{{ $grade }}</span>
                @endforeach
            @else
                <span class="tag">{{ $teacher->grades }}</span>
            @endif
        </div>
    </div>
    <div class="info-card">
        <label>Priority</label>
        <div class="value">
            <span class="badge badge-{{ $teacher->priority }}">
                {{ ucfirst($teacher->priority) }}
            </span>
        </div>
    </div>
    <div class="info-card">
        <label>Available Days</label>
        <div class="value">
            @if(is_array($teacher->days) || is_object($teacher->days))
                @foreach($teacher->days as $day)
                    <span class="tag">{{ $day }}</span>
                @endforeach
            @else
                <span class="tag">{{ $teacher->days }}</span>
            @endif
        </div>
    </div>
</div>

<!-- Schedule -->
<div id="schedule" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 20px;">
    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #f1f5f9;">📅 My Schedule</h2>
    
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
    <div style="text-align: center; padding: 40px; color: rgba(255,255,255,0.3);">
        <div style="font-size: 40px; margin-bottom: 12px;">📋</div>
        <p>No schedule assigned yet</p>
        <p style="font-size: 12px; color: rgba(255,255,255,0.15);">Contact admin to create your schedule</p>
    </div>
    @endif
</div>

<script>
    function showUnavailableForm() {
        document.getElementById('unavailableForm').style.display = 'block';
    }
    function hideUnavailableForm() {
        document.getElementById('unavailableForm').style.display = 'none';
    }
</script>
@endsection