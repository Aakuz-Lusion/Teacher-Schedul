@extends('layouts.admin')

@section('title', 'Timetable')
@section('header', '📅 School Timetable')
@section('subtitle', 'Complete schedule for all grades')

@section('actions')
    <a href="{{ route('admin.generate-schedule') }}" class="btn btn-success">🔄 Generate Schedule</a>
@endsection

@section('styles')
<style>
    .body{
        background: #353c43;
        font-family: Times New Roman, Times, serif;
    }
    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
        margin-top: 10px;
    }

    .grade-card {   
        background: white;
        border: 1px solid #6852b7;
        border-radius: 8px;
        padding: 16px;
        overflow-x: auto;
    }

    .grade-card h3 {
        background: #333;
        color: white;
        padding: 10px 14px;
        margin: -16px -16px 16px -16px;
        border-radius: 8px 8px 0 0;
        font-size: 18px;
        text-align: center;
    }

    .schedule-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        min-width: 500px;
    }

    .schedule-table th {
        background: #ab56d8;
        padding: 8px 10px;
        text-align: center;
        border: 1px solid #ddd;
        font-weight: 700;
        font-size: 12px;
    }

    .schedule-table td {
        padding: 8px 6px;
        text-align: center;
        border: 1px solid #ddd;
        min-width: 60px;
    }

    .schedule-table .period-label {
        font-weight: 700;
        background: #f8f8f8;
        color: #333;
    }

    .cell-assigned {
        background: #d4edda;
        color: #155724;
    }

    .cell-unassigned {
        background: #f8f9fa;
        color: #999;
    }

    .subject-badge {
        display: inline-block;
        background: #007bff;
        color: white;
        padding: 2px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .teacher-name {
        font-size: 12px;
        color: #333;
        margin-top: 2px;
        display: block;
    }

    .stats-bar {
        margin-top: 25px;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #ddd;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        font-size: 14px;
    }

    .stats-bar strong {
        color: #333;
    }

    .assigned {
        color: #28a745;
    }

    .unassigned {
        color: #dc3545;
    }

    @media (max-width: 768px) {
        .schedule-grid {
            grid-template-columns: 1fr;
        }
        .grade-card {
            padding: 12px;
        }
        .grade-card h3 {
            font-size: 16px;
        }
        .schedule-table {
            font-size: 11px;
            min-width: 400px;
        }
        .schedule-table th,
        .schedule-table td {
            padding: 5px 4px;
        }
        .subject-badge {
            font-size: 10px;
            padding: 1px 6px;
        }
        .teacher-name {
            font-size: 10px;
        }
    }

    @media (max-width: 480px) {
        .schedule-table {
            font-size: 10px;
            min-width: 320px;
        }
        .schedule-table th,
        .schedule-table td {
            padding: 4px 3px;
        }
    }
</style>
@endsection

@section('content')
@php
    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    $periodMap = [
        ['id' => 1,  'label' => 'P1', 'time' => '10:00–10:45'],
        ['id' => 2,  'label' => 'P2', 'time' => '10:45–11:30'],
        ['id' => 4,  'label' => 'P3', 'time' => '11:45–12:30'],
        ['id' => 5,  'label' => 'P4', 'time' => '12:30–1:15'],
        ['id' => 7,  'label' => 'P5', 'time' => '2:00–2:45'],
        ['id' => 8,  'label' => 'P6', 'time' => '2:45–3:30'],
        ['id' => 10, 'label' => 'P7', 'time' => '3:45–4:30'],
    ];

    $grades = ['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade 4-B', 'Grade 5-A', 'Grade 5-B'];
    $allSchedules = \App\Models\Schedule::all()->groupBy('grade');
@endphp

<div class="schedule-grid">
    @foreach($grades as $grade)
        <div class="grade-card">
            <h3>{{ $grade }}</h3>

            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Period</th>
                        @foreach($days as $day)
                            <th>{{ substr($day, 0, 3) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodMap as $periodData)
                        <tr>
                            <td class="period-label">{{ $periodData['label'] }}</td>
                            @foreach($days as $day)
                                @php
                                    $schedule = $allSchedules[$grade] ?? collect();
                                    $entry = $schedule->where('day', $day)->where('period_id', $periodData['id'])->first();
                                    $isAssigned = $entry && $entry->teacher_name != '—';
                                @endphp
                                <td class="{{ $isAssigned ? 'cell-assigned' : 'cell-unassigned' }}">
                                    @if($isAssigned)
                                        <span class="subject-badge">{{ ucfirst($entry->subject) }}</span>
                                        <span class="teacher-name">{{ $entry->teacher_name }}</span>
                                    @else
                                        <span style="color: #999;">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>

<div class="stats-bar">
    <span>📊 Total Schedules: <strong>{{ \App\Models\Schedule::count() }}</strong></span>
    <span class="assigned">✅ Assigned: <strong>{{ \App\Models\Schedule::where('teacher_name', '!=', '—')->count() }}</strong></span>
    <span class="unassigned">❌ Unassigned: <strong>{{ \App\Models\Schedule::where('teacher_name', '—')->count() }}</strong></span>
</div>
@endsection