<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teacher Dashboard') - Teacher Scheduler</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #0a0e1a;
            color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            background-image: 
                radial-gradient(ellipse at 10% 20%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(139, 92, 246, 0.10) 0%, transparent 50%);
        }
        
        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 270px;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(24px) saturate(1.4);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            padding: 24px 16px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 4px 12px 24px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 20px;
        }
        .sidebar-brand .logo {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.25);
        }
        .sidebar-brand .brand-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #f1f5f9, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .sidebar-brand .brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.2);
            -webkit-text-fill-color: rgba(255,255,255,0.2);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        /* ===== USER CARD ===== */
        .sidebar .user-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 14px;
            padding: 16px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.3s ease;
        }
        .sidebar .user-card:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.10);
        }
        .sidebar .user-card .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 12px rgba(99, 102, 241, 0.2);
        }
        .sidebar .user-card .user-info {
            flex: 1;
            min-width: 0;
        }
        .sidebar .user-card .name {
            font-weight: 600;
            font-size: 14px;
            color: #f1f5f9;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar .user-card .email {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar .user-card .status {
            font-size: 10px;
            font-weight: 600;
            padding: 2px 12px;
            border-radius: 100px;
            display: inline-block;
            margin-top: 3px;
        }
        .sidebar .user-card .status-available {
            background: rgba(34, 197, 94, 0.12);
            color: #6ee7b7;
        }
        .sidebar .user-card .status-unavailable {
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
        }
        
        /* ===== NAVIGATION ===== */
        .sidebar .nav-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255,255,255,0.12);
            padding: 20px 12px 8px 12px;
            font-weight: 600;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: all 0.25s ease;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 2px;
            position: relative;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.04);
            color: #f1f5f9;
        }
        .sidebar a.active {
            background: rgba(99, 102, 241, 0.10);
            color: #a5b4fc;
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.03);
        }
        .sidebar a.active::before {
            content: '';
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: linear-gradient(180deg, #6366f1, #8b5cf6);
            border-radius: 0 4px 4px 0;
        }
        .sidebar a .icon {
            font-size: 18px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
        }
        
        .sidebar .logout-link {
            margin-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 16px;
            color: rgba(239, 68, 68, 0.3);
        }
        .sidebar .logout-link:hover {
            background: rgba(239, 68, 68, 0.04);
            color: #fca5a5;
        }
        .sidebar .logout-link .icon {
            font-size: 16px;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 270px;
            flex: 1;
            padding: 28px 36px 40px 36px;
            min-height: 100vh;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }
        .page-header h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #f1f5f9, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .page-header .subtitle {
            color: rgba(255,255,255,0.3);
            font-size: 13px;
            font-weight: 400;
            margin-top: 2px;
        }
        .page-header .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        /* ===== FLASH MESSAGES ===== */
        .flash {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.4s ease;
        }
        .flash-success {
            background: rgba(34, 197, 94, 0.10);
            border: 1px solid rgba(34,197,94,0.12);
            color: #6ee7b7;
        }
        .flash-error {
            background: rgba(239, 68, 68, 0.10);
            border: 1px solid rgba(239,68,68,0.12);
            color: #fca5a5;
        }
        .flash-info {
            background: rgba(99, 102, 241, 0.10);
            border: 1px solid rgba(99,102,241,0.12);
            color: #a5b4fc;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* ===== CONTENT AREA ===== */
        .content-area {
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* ===== MOBILE TOGGLE ===== */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 200;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 8px 14px;
            color: #f1f5f9;
            cursor: pointer;
            font-size: 20px;
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }
        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.08);
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.6);
            z-index: 99;
            backdrop-filter: blur(4px);
        }
        .sidebar-overlay.active {
            display: block;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                border-right: none;
                box-shadow: 4px 0 40px rgba(0,0,0,0.3);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-toggle {
                display: block;
            }
            .main-content {
                margin-left: 0;
                padding: 20px 16px 32px 16px;
                margin-top: 60px;
            }
            .page-header h1 {
                font-size: 22px;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 16px 12px 24px 12px;
            }
            .page-header h1 {
                font-size: 18px;
            }
            .page-header .subtitle {
                font-size: 12px;
            }
            .sidebar .user-card {
                padding: 12px 14px;
            }
        }
        
        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.15); }
        
        /* ===== SELECTION ===== */
        ::selection {
            background: rgba(99, 102, 241, 0.25);
            color: #f1f5f9;
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Mobile Toggle -->
<button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">☰</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- ===== SIDEBAR ===== -->
<nav class="sidebar" id="sidebar" role="navigation">
    <div class="sidebar-brand">
        <div class="logo">📚</div>
        <div>
            <div class="brand-text">Scheduler</div>
            <div class="brand-sub">Teacher Portal</div>
        </div>
    </div>
    
    @if(isset($teacher))
    <div class="user-card">
        <div class="avatar">{{ strtoupper(substr($teacher->name, 0, 2)) }}</div>
        <div class="user-info">
            <div class="name">{{ $teacher->name }}</div>
            <div class="email">{{ $teacher->email }}</div>
            <div>
                <span class="status {{ $teacher->is_available ? 'status-available' : 'status-unavailable' }}">
                    {{ $teacher->is_available ? '✅ Available' : '❌ Unavailable' }}
                </span>
            </div>
        </div>
    </div>
    @endif
    
    <div class="nav-label">Main</div>
    <a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
        <span class="icon">📊</span> Dashboard
    </a>
    <a href="{{ route('teacher.dashboard') }}#schedule" class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
        <span class="icon">📅</span> My Schedule
    </a>
    
    <div class="nav-label">Account</div>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
        <span class="icon">🚪</span> Logout
    </a>
    
    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>

<!-- ===== MAIN CONTENT ===== -->
<main class="main-content">
    <div class="page-header">
        <div>
            <h1>@yield('header', 'Dashboard')</h1>
            <p class="subtitle">@yield('subtitle', 'Welcome back, Teacher!')</p>
        </div>
        <div class="actions">
            @yield('actions')
        </div>
    </div>
    
    @if(session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="flash flash-info">{{ session('info') }}</div>
    @endif
    
    <div class="content-area">
        @yield('content')
    </div>
</main>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }
    
    // Close sidebar on resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('active');
        }
    });
    
    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('sidebar').classList.contains('open')) {
            toggleSidebar();
        }
    });
</script>

@yield('scripts')
</body>
</html>