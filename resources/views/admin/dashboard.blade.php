@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', '👑 Admin Dashboard')
@section('subtitle', 'Manage teachers, schedules, and more')

@section('actions')
    <a href="{{ route('teachers.create') }}" style="padding: 10px 20px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; border: none; border-radius: 12px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.3s ease;">
        + Add Teacher
    </a>
    <a href="{{ route('admin.generate-schedule') }}" style="padding: 10px 20px; background: rgba(34,197,94,0.12); color: #6ee7b7; border: 1px solid rgba(34,197,94,0.15); border-radius: 12px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.3s ease;">
        🔄 Generate Schedule
    </a>
@endsection

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
    }
    .stat-number {
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .stat-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.3);
        margin-top: 4px;
    }
    .table-container {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }
    th {
        text-align: left;
        padding: 12px 14px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255,255,255,0.3);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        font-weight: 600;
    }
    td {
        padding: 12px 14px;
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
    .badge-high { background: rgba(239,68,68,0.15); color: #fca5a5; }
    .badge-medium { background: rgba(251,191,36,0.15); color: #fcd34d; }
    .badge-low { background: rgba(34,197,94,0.15); color: #6ee7b7; }
    .badge-available { background: rgba(34,197,94,0.12); color: #6ee7b7; }
    .badge-unavailable { background: rgba(239,68,68,0.12); color: #fca5a5; }
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
    .btn-action {
        padding: 4px 14px;
        border: none;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-family: 'Inter', sans-serif;
    }
    .btn-primary {
        background: rgba(99,102,241,0.12);
        color: #a5b4fc;
        border: 1px solid rgba(99,102,241,0.1);
    }
    .btn-primary:hover {
        background: rgba(99,102,241,0.2);
    }
    .btn-success {
        background: rgba(34,197,94,0.12);
        color: #6ee7b7;
        border: 1px solid rgba(34,197,94,0.1);
    }
    .btn-success:hover {
        background: rgba(34,197,94,0.2);
    }
    .btn-danger {
        background: rgba(239,68,68,0.12);
        color: #fca5a5;
        border: 1px solid rgba(239,68,68,0.1);
    }
    .btn-danger:hover {
        background: rgba(239,68,68,0.2);
    }
    .actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }
</style>
@endsection

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $teachers->count() }}</div>
        <div class="stat-label">Total Teachers</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" style="background: linear-gradient(135deg, #34d399, #22c55e); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $availableTeachers }}
        </div>
        <div class="stat-label">✅ Available Today</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" style="background: linear-gradient(135deg, #f87171, #ef4444); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $unavailableTeachers }}
        </div>
        <div class="stat-label">❌ Unavailable Today</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" style="background: linear-gradient(135deg, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            {{ $totalSchedules }}
        </div>
        <div class="stat-label">📅 Total Schedules</div>
    </div>
</div>

<div style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 20px;">
    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 16px; color: #f1f5f9;">👨‍🏫 All Teachers</h2>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Grades</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $index => $teacher)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $teacher->name }}</strong></td>
                    <td>{{ ucfirst($teacher->subject) }}</td>
                    <td>
                        @if(is_array($teacher->grades) || is_object($teacher->grades))
                            @foreach($teacher->grades as $grade)
                                <span class="tag">{{ $grade }}</span>
                            @endforeach
                        @else
                            <span class="tag">{{ $teacher->grades }}</span>
                        @endif
                    </td>
                    <td><span class="badge badge-{{ $teacher->priority }}">{{ ucfirst($teacher->priority) }}</span></td>
                    <td>
                        <span class="badge {{ $teacher->is_available ? 'badge-available' : 'badge-unavailable' }}">
                            {{ $teacher->is_available ? '✅ Available' : '❌ Unavailable' }}
                        </span>
                        @if(!$teacher->is_available && $teacher->unavailable_reason)
                            <br><small style="color: rgba(255,255,255,0.3); font-size: 10px;">{{ $teacher->unavailable_reason }}</small>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.change-password', $teacher->id) }}" class="btn-action btn-primary">🔑</a>
                            @if(!$teacher->is_available)
                                <a href="{{ route('admin.replacement', $teacher->id) }}" class="btn-action btn-success">🔄</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: rgba(255,255,255,0.3);">
                        No teachers found. <a href="{{ route('teachers.create') }}" style="color: #6366f1; text-decoration: none;">Add your first teacher</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection