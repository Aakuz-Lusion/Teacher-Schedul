<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #080c18;
            color: #f1f5f9;
            min-height: 100vh;
            padding: 20px;
            background-image: 
                radial-gradient(ellipse at 10% 20%, rgba(59, 130, 246, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.12) 0%, transparent 50%);
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }
        h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #60a5fa 0%, #a78bfa 40%, #60a5fa 80%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .subtitle {
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 30px;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: rgba(255, 255, 255, 0.7);
        }
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
        input, select {
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
        input:focus, select:focus {
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
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('teachers.index') }}" class="back-link">← Back to Teachers</a>
        
        <h1>👨‍🏫 Add New Teacher</h1>
        <p class="subtitle">Fill in the details to add a new teacher</p>

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
                    <label class="required">Grade/Class</label>
                    <select name="grade" required>
                        <option value="">Select Grade</option>
                        <option value="Grade 1-A" {{ old('grade') == 'Grade 1-A' ? 'selected' : '' }}>Grade 1-A</option>
                        <option value="Grade 1-B" {{ old('grade') == 'Grade 1-B' ? 'selected' : '' }}>Grade 1-B</option>
                        <option value="Grade 2-A" {{ old('grade') == 'Grade 2-A' ? 'selected' : '' }}>Grade 2-A</option>
                        <option value="Grade 2-B" {{ old('grade') == 'Grade 2-B' ? 'selected' : '' }}>Grade 2-B</option>
                        <option value="Grade 3-A" {{ old('grade') == 'Grade 3-A' ? 'selected' : '' }}>Grade 3-A</option>
                        <option value="Grade 3-B" {{ old('grade') == 'Grade 3-B' ? 'selected' : '' }}>Grade 3-B</option>
                        <option value="Grade 4-A" {{ old('grade') == 'Grade 4-A' ? 'selected' : '' }}>Grade 4-A</option>
                        <option value="Grade 4-B" {{ old('grade') == 'Grade 4-B' ? 'selected' : '' }}>Grade 4-B</option>
                        <option value="Grade 5-A" {{ old('grade') == 'Grade 5-A' ? 'selected' : '' }}>Grade 5-A</option>
                        <option value="Grade 5-B" {{ old('grade') == 'Grade 5-B' ? 'selected' : '' }}>Grade 5-B</option>
                    </select>
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
                    <label>
                        <input type="checkbox" name="days[]" value="Sunday" {{ is_array(old('days')) && in_array('Sunday', old('days')) ? 'checked' : '' }}>
                        Sunday
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Monday" {{ is_array(old('days')) && in_array('Monday', old('days')) ? 'checked' : '' }}>
                        Monday
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Tuesday" {{ is_array(old('days')) && in_array('Tuesday', old('days')) ? 'checked' : '' }}>
                        Tuesday
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Wednesday" {{ is_array(old('days')) && in_array('Wednesday', old('days')) ? 'checked' : '' }}>
                        Wednesday
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Thursday" {{ is_array(old('days')) && in_array('Thursday', old('days')) ? 'checked' : '' }}>
                        Thursday
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Friday" {{ is_array(old('days')) && in_array('Friday', old('days')) ? 'checked' : '' }}>
                        Friday
                    </label>
                </div>
                <div class="helper-text">Hold Ctrl to select multiple, or click individually</div>
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
                <div class="helper-text">Hold Ctrl to select multiple, or click individually</div>
            </div>

            <div class="form-actions">
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Teacher</button>
            </div>
        </form>
    </div>

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
</body>
</html>