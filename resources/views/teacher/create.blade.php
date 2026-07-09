@extends('layouts.admin')

@section('title', 'Add Teacher')
@section('header', 'Add New Teacher')
@section('subtitle', 'Fill in the details')

@section('content')
    <form method="POST" action="{{ route('teachers.store') }}">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label>Full Name <span style="color:red;">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;">
            </div>
            <div>
                <label>Email <span style="color:red;">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
            <div>
                <label>Password <span style="color:red;">*</span></label>
                <input type="password" name="password" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;">
            </div>
            <div>
                <label>Subject <span style="color:red;">*</span></label>
                <select name="subject" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;">
                    <option value="">Select Subject</option>
                    <option value="math" {{ old('subject') == 'math' ? 'selected' : '' }}>Mathematics</option>
                    <option value="english" {{ old('subject') == 'english' ? 'selected' : '' }}>English</option>
                    <option value="nepali" {{ old('subject') == 'nepali' ? 'selected' : '' }}>Nepali</option>
                    <option value="science" {{ old('subject') == 'science' ? 'selected' : '' }}>Science</option>
                    <option value="social" {{ old('subject') == 'social' ? 'selected' : '' }}>Social Studies</option>
                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <label>Grades (Select 1-5) <span style="color:red;">*</span></label>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px;">
                @foreach(['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade 4-B', 'Grade 5-A', 'Grade 5-B'] as $grade)
                    <label style="display: inline-flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="grades[]" value="{{ $grade }}" {{ is_array(old('grades')) && in_array($grade, old('grades')) ? 'checked' : '' }}>
                        {{ $grade }}
                    </label>
                @endforeach
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
            <div>
                <label>Priority <span style="color:red;">*</span></label>
                <select name="priority" required style="width:100%; padding:8px; border:1px solid #ddd; border-radius:4px;">
                    <option value="">Select Priority</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div>
                <label>Available Days (Select at least 3) <span style="color:red;">*</span></label>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px;">
                    @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                        <label style="display: inline-flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="days[]" value="{{ $day }}" {{ is_array(old('days')) && in_array($day, old('days')) ? 'checked' : '' }}>
                            {{ $day }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <label>Available Periods (Select 3-5) <span style="color:red;">*</span></label>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px;">
                <label><input type="checkbox" name="periods[]" value="1" {{ is_array(old('periods')) && in_array('1', old('periods')) ? 'checked' : '' }}> Period 1 (10:00–10:45)</label>
                <label><input type="checkbox" name="periods[]" value="2" {{ is_array(old('periods')) && in_array('2', old('periods')) ? 'checked' : '' }}> Period 2 (10:45–11:30)</label>
                <label><input type="checkbox" name="periods[]" value="4" {{ is_array(old('periods')) && in_array('4', old('periods')) ? 'checked' : '' }}> Period 3 (11:45–12:30)</label>
                <label><input type="checkbox" name="periods[]" value="5" {{ is_array(old('periods')) && in_array('5', old('periods')) ? 'checked' : '' }}> Period 4 (12:30–1:15)</label>
                <label><input type="checkbox" name="periods[]" value="7" {{ is_array(old('periods')) && in_array('7', old('periods')) ? 'checked' : '' }}> Period 5 (2:00–2:45)</label>
                <label><input type="checkbox" name="periods[]" value="8" {{ is_array(old('periods')) && in_array('8', old('periods')) ? 'checked' : '' }}> Period 6 (2:45–3:30)</label>
                <label><input type="checkbox" name="periods[]" value="10" {{ is_array(old('periods')) && in_array('10', old('periods')) ? 'checked' : '' }}> Period 7 (3:45–4:30)</label>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success">Add Teacher</button>
            <a href="{{ route('teachers.index') }}" class="btn" style="background: #6c757d;">Cancel</a>
        </div>
    </form>
@endsection