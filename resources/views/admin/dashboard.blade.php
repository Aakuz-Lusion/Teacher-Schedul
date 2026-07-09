@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header', 'Admin Dashboard')
@section('subtitle', 'Manage teachers and schedules')

@section('content')
    <div style="display: flex; gap: 20px; margin: 20px 0;">
        <div style="background: #e9ecef; padding: 20px; border-radius: 5px; flex: 1;">
            <h3>Total Teachers</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $teachers->count() }}</p>
        </div>
        <div style="background: #d4edda; padding: 20px; border-radius: 5px; flex: 1;">
            <h3>✅ Available</h3>
            <p style="font-size: 24px; font-weight: bold; color: #155724;">{{ $availableTeachers }}</p>
        </div>
        <div style="background: #f8d7da; padding: 20px; border-radius: 5px; flex: 1;">
            <h3>❌ Unavailable</h3>
            <p style="font-size: 24px; font-weight: bold; color: #721c24;">{{ $unavailableTeachers }}</p>
        </div>
        <div style="background: #d1ecf1; padding: 20px; border-radius: 5px; flex: 1;">
            <h3>📅 Schedules</h3>
            <p style="font-size: 24px; font-weight: bold; color: #0c5460;">{{ $totalSchedules }}</p>
        </div>
    </div>

    <a href="{{ route('teachers.create') }}" class="btn btn-success" style="margin-bottom: 15px;">+ Add Teacher</a>
    <a href="{{ route('admin.generate-schedule') }}" class="btn" style="margin-bottom: 15px;">🔄 Generate Schedule</a>

    <h2>All Teachers</h2>
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
                    @if(is_array($teacher->grades))
                        {{ implode(', ', $teacher->grades) }}
                    @else
                        {{ $teacher->grades }}
                    @endif
                </td>
                <td>{{ ucfirst($teacher->priority) }}</td>
                <td>{{ $teacher->is_available ? '✅ Available' : '❌ Unavailable' }}</td>
                <td>
                    <a href="{{ route('admin.change-password', $teacher->id) }}" class="btn btn-sm">🔑</a>
                    @if(!$teacher->is_available)
                        <a href="{{ route('admin.replacement', $teacher->id) }}" class="btn btn-success btn-sm">🔄</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align: center; padding: 30px;">No teachers found.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection