@extends('layouts.admin')

@section('title', 'Timetable')
@section('header', '📅 School Timetable')
@section('subtitle', 'Complete schedule for all grades')

@section('actions')
<a href="{{ route('admin.generate-schedule') }}" class="btn btn-primary">🔄 Generate Schedule</a>
@endsection

@section('styles')
<style>

.schedule-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
    gap: 24px;
    align-items: start;
}



.grade-card {
    background: rgba(255, 255, 255, .03);
    border: 1px solid rgba(255, 255, 255, .08);
    border-radius: 18px;
    padding: 22px;
    overflow: visible;      /* ← CHANGED: was 'hidden' */
    transition: .3s ease;
    position: relative;     /* ← ADDED: for tooltip positioning */
}

.grade-card:hover {
    border-color: rgba(99, 102, 241, .3);
    box-shadow: 0 12px 30px rgba(0, 0, 0, .25);
}

.grade-card h3 {
    margin: 0 0 18px;
    padding-bottom: 12px;
    color: #fff;
    font-size: 24px;
    font-weight: 700;
    border-bottom: 1px solid rgba(255, 255, 255, .08);
}



.schedule-row {
    display: grid;
    grid-template-columns: 50px repeat(6, minmax(70px, 1fr));
    gap: 8px;
    align-items: stretch;
    padding: 6px 0;
}

.schedule-row+.schedule-row {
    border-top: 1px solid rgba(255, 255, 255, .05);
}

.schedule-row-header {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: rgba(255, 255, 255, .5);
    margin-bottom: 8px;
}

.schedule-row-header span {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===========================
   PERIOD LABEL
=========================== */

.period-label {
    display: flex;
    justify-content: center;
    align-items: center;
    color: rgba(255, 255, 255, .55);
    font-weight: 700;
    font-size: 12px;
}

/* ===========================
   CELLS
=========================== */

.schedule-cell {
    height: 68px;
    min-height: 68px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    border-radius: 12px;
    text-align: center;

    padding: 6px;

    position: relative;

    transition: .25s ease;

    /* REMOVED: overflow: hidden; - tooltips need to show outside */
}

.schedule-cell:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, .25);
    z-index: 10;            /* ← ADDED: bring cell above others on hover */
}

/* ===========================
   ASSIGNED
=========================== */

.cell-assigned {
    background: rgba(99, 102, 241, .14);
    border: 1px solid rgba(99, 102, 241, .25);
}

.cell-assigned:hover {
    background: rgba(99, 102, 241, .22);
    border-color: #818cf8;
}

/* ===========================
   EMPTY
=========================== */

.cell-unassigned {
    background: rgba(255, 255, 255, .03);
    border: 1px dashed rgba(255, 255, 255, .08);
    color: rgba(255, 255, 255, .2);
}

.cell-unassigned:hover {
    background: rgba(255, 255, 255, .05);
}

/* ===========================
   SUBJECT
=========================== */

.subject-badge {
    background: #6366f1;
    color: white;

    padding: 3px 10px;

    border-radius: 50px;

    font-size: 11px;
    font-weight: 700;

    margin-bottom: 4px;
}

/* ===========================
   TEACHER
=========================== */

.teacher-name {
    font-size: 11px;
    color: white;

    line-height: 1.2;

    max-width: 100%;

    overflow: hidden;

    text-overflow: ellipsis;

    display: -webkit-box;

    -webkit-line-clamp: 2;

    -webkit-box-orient: vertical;
}

/* ===========================
   TOOLTIP - FIXED
=========================== */

.tooltip {
    position: absolute;
    left: 50%;
    bottom: calc(100% + 12px);

    transform: translateX(-50%);

    display: none;

    background: #1f2937;

    border-radius: 12px;

    padding: 14px 18px;

    min-width: 180px;

    border: 1px solid rgba(255, 255, 255, .10);

    box-shadow: 0 16px 48px rgba(0, 0, 0, .5);

    z-index: 9999;          /* ← CHANGED: higher z-index */

    text-align: left;

    pointer-events: none;   /* ← ADDED: prevents tooltip from interfering with hover */

    animation: tooltipFade 0.2s ease;
}

.schedule-cell:hover .tooltip {
    display: block;
}

/* Tooltip arrow */
.tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 8px solid transparent;
    border-top-color: #1f2937;
}

.tip-subject {
    color: #818cf8;
    font-size: 16px;
    font-weight: 700;
}

.tip-teacher,
.tip-grade {
    color: white;
    margin-top: 4px;
    font-size: 13px;
}

.tip-time {
    color: rgba(255, 255, 255, .5);
    margin-top: 8px;
    border-top: 1px solid rgba(255, 255, 255, .08);
    padding-top: 8px;
    font-size: 12px;
}

/* Tooltip animation */
@keyframes tooltipFade {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

/* ===========================
   STATS
=========================== */

.stats-bar {
    margin-top: 30px;

    display: flex;

    flex-wrap: wrap;

    gap: 18px;

    padding-top: 20px;

    border-top: 1px solid rgba(255, 255, 255, .08);

    color: rgba(255, 255, 255, .75);
}

.stats-bar strong {
    color: white;
}

.assigned {
    color: #22c55e;
}

.unassigned {
    color: #ef4444;
}

/* ===========================
   RESPONSIVE
=========================== */

@media (max-width:1200px) {
    .schedule-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width:768px) {
    .grade-card {
        overflow-x: auto;    /* ← CHANGED: scroll on small screens only */
    }

    .schedule-row {
        min-width: 620px;
    }

    .tooltip {
        min-width: 140px;
        padding: 10px 14px;
        font-size: 12px;
    }
    .tip-subject {
        font-size: 14px;
    }
    .tip-teacher,
    .tip-grade {
        font-size: 12px;
    }
}

@media (max-width:480px) {
    .schedule-cell {
        height: 52px;
        min-height: 52px;
        font-size: 9px;
    }
    .subject-badge {
        font-size: 8px;
        padding: 2px 6px;
    }
    .teacher-name {
        font-size: 8px;
    }
    .period-label {
        font-size: 9px;
    }
    .tooltip {
        min-width: 120px;
        padding: 8px 12px;
        font-size: 11px;
        bottom: calc(100% + 8px);
    }
    .tip-subject {
        font-size: 12px;
    }
}
</style>
@endsection

@section('content')
@php
$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// PERIOD MAPPING: 7 teaching periods (period IDs 1,2,4,5,7,8,10)
// Display as Period 1 to Period 7
$periodMap = [
['id' => 1, 'label' => 'P1', 'time' => '10:00–10:45'],
['id' => 2, 'label' => 'P2', 'time' => '10:45–11:30'],
['id' => 4, 'label' => 'P3', 'time' => '11:45–12:30'],
['id' => 5, 'label' => 'P4', 'time' => '12:30–1:15'],
['id' => 7, 'label' => 'P5', 'time' => '2:00–2:45'],
['id' => 8, 'label' => 'P6', 'time' => '2:45–3:30'],
['id' => 10, 'label' => 'P7', 'time' => '3:45–4:30'],
];

$grades = ['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade 4-B',
'Grade 5-A', 'Grade 5-B'];
$allSchedules = \App\Models\Schedule::all()->groupBy('grade');
@endphp

<div class="schedule-grid">
    @foreach($grades as $grade)
    <div class="grade-card">
        <h3>{{ $grade }}</h3>

        <!-- Header Row -->
        <div class="schedule-row schedule-row-header">
            <span>P</span>
            @foreach($days as $day)
            <span>{{ substr($day, 0, 3) }}</span>
            @endforeach
        </div>

        <!-- Period Rows -->
        @foreach($periodMap as $periodData)
        <div class="schedule-row">
            <span class="period-label">{{ $periodData['label'] }}</span>

            @foreach($days as $day)
            @php
            $schedule = $allSchedules[$grade] ?? collect();
            $entry = $schedule->where('day', $day)->where('period_id', $periodData['id'])->first();
            $isAssigned = $entry && $entry->teacher_name != '—';
            @endphp

            <div class="schedule-cell {{ $isAssigned ? 'cell-assigned' : 'cell-unassigned' }}"
                title="{{ $isAssigned ? $entry->teacher_name . ' - ' . ucfirst($entry->subject) : 'Unassigned' }}">
                @if($isAssigned)
                <div class="subject-badge">{{ ucfirst($entry->subject) }}</div>
                <div class="teacher-name">{{ $entry->teacher_name }}</div>

                <!-- Tooltip/Popup -->
                <div class="tooltip">
                    <div class="tip-subject">{{ ucfirst($entry->subject) }}</div>
                    <div class="tip-teacher"> {{ $entry->teacher_name }}</div>
                    <div class="tip-grade">{{ $entry->grade }}</div>
                    <div class="tip-time">{{ $day }} • {{ $periodData['time'] }}</div>
                </div>
                @else
                <span style="font-size: 10px; opacity: 0.3;">—</span>
                @endif
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @endforeach
</div>

<div class="stats-bar">
    <span>Total Schedules: <strong>{{ \App\Models\Schedule::count() }}</strong></span>
    <span class="assigned">✅ Assigned:
        <strong>{{ \App\Models\Schedule::where('teacher_name', '!=', '—')->count() }}</strong></span>
    <span class="unassigned">❌ Unassigned:
        <strong>{{ \App\Models\Schedule::where('teacher_name', '—')->count() }}</strong></span>
</div>
@endsection