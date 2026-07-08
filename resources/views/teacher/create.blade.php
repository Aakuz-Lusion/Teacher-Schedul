@extends('layouts.admin')

@section('title', 'Add Teacher')
@section('header', '👨‍🏫 Add New Teacher')
@section('subtitle', 'Fill in the details to add a new teacher')

@section('styles')
<style>
    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: rgba(255, 255, 255, 0.6);
        font-size: 13px;
        margin-bottom: 6px;
        font-weight: 500;
    }

    label.required::after {
        content: ' *';
        color: #f87171;
    }

    input,
    select {
        width: 100%;
        padding: 12px 16px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        color: white;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: #60a5fa;
        background: rgba(255, 255, 255, 0.07);
        box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.1);
    }

    input::placeholder {
        color: rgba(255, 255, 255, 0.2);
    }

    select option {
        background: #1a1a2e;
        color: white;
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 8px;
    }

    .checkbox-group label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.6);
        font-size: 13px;
        cursor: pointer;
        padding: 8px 14px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .checkbox-group label:hover {
        background: rgba(255, 255, 255, 0.06);
    }

    .checkbox-group input[type="checkbox"] {
        width: 16px;
        height: 16px;
        min-width: 16px;
        accent-color: #60a5fa;
        cursor: pointer;
        margin: 0;
    }

    .checkbox-group label.checked {
        background: rgba(96, 165, 250, 0.15);
        border-color: rgba(96, 165, 250, 0.3);
        color: white;
    }

    .error {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        color: #fca5a5;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .error ul {
        list-style: none;
        margin: 0;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        flex: 1;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #7c3aed);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .helper-text {
        color: rgba(255, 255, 255, 0.3);
        font-size: 12px;
        margin-top: 5px;
    }

    .success {
        background: rgba(34, 197, 94, 0.15);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        color: #6ee7b7;
        margin-bottom: 20px;
    }

    .row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 640px) {
        .row {
            grid-template-columns: 1fr;
        }
        .form-actions {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teachers.store') }}">
        @csrf

        <div class="row">
            <div class="form-group">
                <label class="required">Full Name</label>
                <input type="text" name="name" placeholder="e.g., Mr. Sharma" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label class="required">Email Address</label>
                <input type="email" name="email" placeholder="teacher@school.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label class="required">Password</label>
                <input type="password" name="password" placeholder="Min 6 characters" required>
            </div>

            <div class="form-group">
                <label class="required">Subject</label>
                <select name="subject" required>
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

        <div class="row">
            <div class="form-group">
                <label class="required">Grades/Classes (Select 1-5)</label>
                <div class="checkbox-group" id="gradesGroup">
                    @foreach(['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade 4-B', 'Grade 5-A', 'Grade 5-B'] as $grade)
                        <label>
                            <input type="checkbox" name="grades[]" value="{{ $grade }}"
                                {{ is_array(old('grades')) && in_array($grade, old('grades')) ? 'checked' : '' }}>
                            {{ $grade }}
                        </label>
                    @endforeach
                </div>
                <div class="helper-text">Select 1-5 grades this teacher will teach</div>
            </div>

            <div class="form-group">
                <label class="required">Priority</label>
                <select name="priority" required>
                    <option value="">Select Priority</option>
                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="required">Available Days (Select at least 3)</label>
            <div class="checkbox-group" id="daysGroup">
                @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                    <label>
                        <input type="checkbox" name="days[]" value="{{ $day }}"
                            {{ is_array(old('days')) && in_array($day, old('days')) ? 'checked' : '' }}>
                        {{ $day }}
                    </label>
                @endforeach
            </div>
            <div class="helper-text">Select at least 3 days</div>
        </div>

        <div class="form-group">
            <label class="required">Available Periods (Select 3-5 periods)</label>
            <div class="checkbox-group" id="periodsGroup">
                <label>
                    <input type="checkbox" name="periods[]" value="1" {{ is_array(old('periods')) && in_array('1', old('periods')) ? 'checked' : '' }}>
                    Period 1 (10:00–10:45)
                </label>
                <label>
                    <input type="checkbox" name="periods[]" value="2" {{ is_array(old('periods')) && in_array('2', old('periods')) ? 'checked' : '' }}>
                    Period 2 (10:45–11:30)
                </label>
                <label>
                    <input type="checkbox" name="periods[]" value="4" {{ is_array(old('periods')) && in_array('4', old('periods')) ? 'checked' : '' }}>
                    Period 3 (11:45–12:30)
                </label>
                <label>
                    <input type="checkbox" name="periods[]" value="5" {{ is_array(old('periods')) && in_array('5', old('periods')) ? 'checked' : '' }}>
                    Period 4 (12:30–1:15)
                </label>
                <label>
                    <input type="checkbox" name="periods[]" value="7" {{ is_array(old('periods')) && in_array('7', old('periods')) ? 'checked' : '' }}>
                    Period 5 (2:00–2:45)
                </label>
                <label>
                    <input type="checkbox" name="periods[]" value="8" {{ is_array(old('periods')) && in_array('8', old('periods')) ? 'checked' : '' }}>
                    Period 6 (2:45–3:30)
                </label>
                <label>
                    <input type="checkbox" name="periods[]" value="10" {{ is_array(old('periods')) && in_array('10', old('periods')) ? 'checked' : '' }}>
                    Period 7 (3:45–4:30)
                </label>
            </div>
            <div class="helper-text">Select 3-5 periods</div>
        </div>

        <div class="form-actions">
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Add Teacher</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Highlight selected checkboxes
    document.querySelectorAll('.checkbox-group input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            this.closest('label').classList.toggle('checked', this.checked);
        });
        // Initialize checked state
        if (checkbox.checked) {
            checkbox.closest('label').classList.add('checked');
        }
    });
</script>
@endsection