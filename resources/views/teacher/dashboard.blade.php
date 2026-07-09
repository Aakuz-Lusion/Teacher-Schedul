@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')
@section('header', 'My Dashboard')
@section('subtitle', 'Welcome, ' . $teacher->name . '!')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin: 20px 0;">
        <div style="background: #000000; padding: 15px; border-radius: 5px;">
            <strong>Subject</strong><br>
            {{ ucfirst($teacher->subject) }}
        </div>
        <div style="background: #000000; padding: 15px; border-radius: 5px;">
            <strong>Grades</strong><br>
            @if(is_array($teacher->grades))
                {{ implode(', ', $teacher->grades) }}
            @else
                {{ $teacher->grades }}
            @endif
        </div>
        <div style="background: #000000; padding: 15px; border-radius: 5px;">
            <strong>Priority</strong><br>
            {{ ucfirst($teacher->priority) }}
        </div>
        <div style="background: #000000; padding: 15px; border-radius: 5px;">
            <strong>Status</strong><br>
            {{ $teacher->is_available ? ' Available' :  Unavailable' }}
        </div>
    </div>

    @if(!$teacher->is_available)
        <form method="POST" action="{{ route('teacher.mark-available') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-success">Mark as Available</button>
        </form>
    @else
        <form method="POST" action="{{ route('teacher.mark-unavailable') }}" style="display: inline;">
            @csrf
            <label>Reason: <input type="text" name="reason" placeholder="Why unavailable?"></label>
            <button type="submit" class="btn btn-danger">Mark Unavailable</button>
        </form>
    @endif

    <h2 style="margin-top: 30px;"> My Schedule</h2>
    @if($teacher->schedules->count() > 0)
        <table>
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
                    <td>{{ $schedule->day }}</td>
                    <td>Period {{ $schedule->period_id }}</td>
                    <td>{{ ucfirst($schedule->subject) }}</td>
                    <td>{{ $schedule->grade }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No schedule assigned yet.</p>
    @endif
@endsection