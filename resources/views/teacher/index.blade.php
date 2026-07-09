@extends('layouts.admin')

@section('title', 'Teachers List')
@section('header', 'Teachers List')
@section('subtitle', 'Manage all teachers and their availability')

@section('actions')
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">+ Add Teacher</a>
@endsection

@section('styles')
<style>
    .stats-bar {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 24px;
        padding: 16px 20px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.04);
        border-radius: 12px;
    }

    .stats-bar span {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.5);
    }

    .stats-bar strong {
        color: #f1f5f9;
        font-weight: 600;
    }

    .stats-bar .available-count {
        color: #6ee7b7;
    }

    .stats-bar .unavailable-count {
        color: #fca5a5;
    }

    .table-container {
        overflow-x: auto;
        margin-top: 4px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    th {
        text-align: left;
        padding: 14px 16px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(255, 255, 255, 0.3);
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        font-weight: 600;
    }

    td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        color: rgba(255, 255, 255, 0.7);
    }

    tr:hover td {
        background: rgba(255, 255, 255, 0.02);
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
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 100px;
        font-size: 11px;
        color: rgba(255, 255, 255, 0.5);
        margin: 2px;
    }

    .actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
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

    .btn-primary-action {
        background: rgba(99, 102, 241, 0.12);
        color: #a5b4fc;
        border: 1px solid rgba(99, 102, 241, 0.10);
    }

    .btn-primary-action:hover {
        background: rgba(99, 102, 241, 0.20);
    }

    .btn-success-action {
        background: rgba(34, 197, 94, 0.12);
        color: #6ee7b7;
        border: 1px solid rgba(34, 197, 94, 0.10);
    }

    .btn-success-action:hover {
        background: rgba(34, 197, 94, 0.20);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: rgba(255, 255, 255, 0.3);
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

    .card-content {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .card-content {
            padding: 12px;
        }
        table {
            font-size: 12px;
        }
        th, td {
            padding: 8px 10px;
        }
        .stats-bar {
            gap: 12px;
            padding: 12px 16px;
        }
        .stats-bar span {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        table {
            font-size: 10px;
        }
        th, td {
            padding: 6px 8px;
        }
        .tag {
            font-size: 9px;
            padding: 1px 8px;
        }
        .badge, .badge-status {
            font-size: 9px;
            padding: 2px 10px;
        }
    }
</style>
@endsection

@section('content')
<!-- Stats -->
<div class="stats-bar">
    <span> Total: <strong>{{ $teachers->count() }}</strong></span>
    <span> Available: <strong class="available-count">{{ $teachers->where('is_available', true)->count() }}</strong></span>
    <span> Unavailable: <strong class="unavailable-count">{{ $teachers->where('is_available', false)->count() }}</strong></span>
</div>

<div class="card-content">
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
                    <td>
                        @if(is_array($teacher->grades) || is_object($teacher->grades))
                            @foreach($teacher->grades as $grade)
                                <span class="tag">{{ $grade }}</span>
                            @endforeach
                        @else
                            <span class="tag">{{ $teacher->grades }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $teacher->priority }}">
                            {{ ucfirst($teacher->priority) }}
                        </span>
                    </td>
                    <td>
                        @if($teacher->is_available)
                            <span class="badge-status badge-available"> Available</span>
                        @else
                            <span class="badge-status badge-unavailable"> Unavailable</span>
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
                               class="btn-action btn-primary-action" 
                               title="Change Password"></a>
                            @if(!$teacher->is_available)
                                <a href="{{ route('admin.replacement', $teacher->id) }}" 
                                   class="btn-action btn-success-action" 
                                   title="Assign Replacement"></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <p>No teachers found.</p>
                            <p><a href="{{ route('teachers.create') }}">Add your first teacher</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection