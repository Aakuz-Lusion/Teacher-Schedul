@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Teacher</h1>
    
    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $teacher->name }}" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $teacher->email }}" required>
        </div>
        
        <div class="form-group">
            <label>Subject</label>
            <select name="subject" required>
                <option value="math" {{ $teacher->subject == 'math' ? 'selected' : '' }}>Math</option>
                <option value="english" {{ $teacher->subject == 'english' ? 'selected' : '' }}>English</option>
                <option value="nepali" {{ $teacher->subject == 'nepali' ? 'selected' : '' }}>Nepali</option>
                <option value="science" {{ $teacher->subject == 'science' ? 'selected' : '' }}>Science</option>
                <option value="social" {{ $teacher->subject == 'social' ? 'selected' : '' }}>Social</option>
                <option value="other" {{ $teacher->subject == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Grades (Select 1-5)</label>
            <div class="checkbox-group">
                @foreach(['Grade 1-A', 'Grade 1-B', 'Grade 2-A', 'Grade 2-B', 'Grade 3-A', 'Grade 3-B', 'Grade 4-A', 'Grade 4-B', 'Grade 5-A', 'Grade 5-B'] as $grade)
                    <label>
                        <input type="checkbox" name="grades[]" value="{{ $grade }}" 
                               {{ is_array($teacher->grades) && in_array($grade, $teacher->grades) ? 'checked' : '' }}>
                        {{ $grade }}
                    </label>
                @endforeach
            </div>
        </div>
        
        <div class="form-group">
            <label>Priority</label>
            <select name="priority" required>
                <option value="high" {{ $teacher->priority == 'high' ? 'selected' : '' }}>High</option>
                <option value="medium" {{ $teacher->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="low" {{ $teacher->priority == 'low' ? 'selected' : '' }}>Low</option>
            </select>
        </div>
        
        <button type="submit">Update Teacher</button>
    </form>
</div>
@endsection