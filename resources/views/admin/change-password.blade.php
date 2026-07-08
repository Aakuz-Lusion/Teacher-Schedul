@extends('layouts.admin')

@section('title', 'Change Password')
@section('header', '🔑 Change Password')
@section('subtitle', 'Update password for ' . $teacher->name)

@section('styles')
<style>
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        color: rgba(255,255,255,0.5);
        font-size: 13px;
        margin-bottom: 6px;
    }
    input {
        width: 100%;
        padding: 12px 16px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        color: white;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
    }
    .btn-submit {
        padding: 12px 24px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(99,102,241,0.35);
    }
    .card {
        max-width: 500px;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 24px;
    }
</style>
@endsection

@section('content')
<div class="card">
    <form method="POST" action="{{ route('admin.update-password', $teacher->id) }}">
        @csrf
        
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" placeholder="Min 6 characters" required>
        </div>
        
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
        </div>
        
        <button type="submit" class="btn-submit">Update Password</button>
    </form>
</div>
@endsection