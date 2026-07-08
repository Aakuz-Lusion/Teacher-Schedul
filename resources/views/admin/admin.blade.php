<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Teacher Scheduler</title>
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
            width: 260px;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(24px);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            padding: 24px 16px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px 24px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            margin-bottom: 24px;
        }
        .sidebar-brand .logo {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .sidebar-brand .brand-text {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #f1f5f9, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .sidebar-brand .brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.2);
            -webkit-text-fill-color: rgba(255,255,255,0.2);
        }
        
        .sidebar .nav-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255,255,255,0.15);
            padding: 16px 12px 8px 12px;
            font-weight: 600;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.04);
            color: #f1f5f9;
        }
        .sidebar a.active {
            background: rgba(99, 102, 241, 0.12);
            color: #a5b4fc;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.05);
        }
        .sidebar a .icon {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }
        .sidebar a .badge {
            margin-left: auto;
            padding: 2px 10px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }
        
        .sidebar .logout-link {
            margin-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            padding-top: 16px;
            color: rgba(239, 68, 68, 0.4);
        }
        .sidebar .logout-link:hover {
            background: rgba(239, 68, 68, 0.05);
            color: #fca5a5;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 24px 32px 40px 32px;
            min-height: 100vh;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }
        .page-header h1 {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #f1f5f9, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .page-header .subtitle {
            color: rgba(255,255,255,0.3);
            font-size: 13px;
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
            padding: 8px 12px;
            color: #f1f5f9;
            cursor: pointer;
            font-size: 20px;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
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
                margin-top: 20px;
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
            }
            .sidebar-overlay.active {
                display: block;
            }
        }
        
        @media (max-width: 480px) {
            .page-header h1 {
                font-size: 20px;
            }
        }
        
        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        
        /* ===== CONTENT AREA ===== */
        .content-area {
            animation: fadeIn 0.4s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Mobile Toggle -->
<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="logo"></div>
        <div>
            <div class="brand-text">Scheduler</div>
            <div class="brand-sub">Teacher Management</div>
        </div>
    </div>
    
    <div class="nav-label">Main</div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="icon">📊</span> Dashboard
    </a>
    <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.index') ? 'active' : '' }}">
        <span class="icon">👨‍🏫</span> Teachers
    </a>
    <a href="{{ route('teachers.create') }}" class="{{ request()->routeIs('teachers.create') ? 'active' : '' }}">
        <span class="icon">➕</span> Add Teacher
    </a>
    
    <div class="nav-label">Schedule</div>
    <a href="{{ route('admin.schedule') }}" class="{{ request()->routeIs('admin.schedule') ? 'active' : '' }}">
        <span class="icon">📅</span> Timetable
    </a>
    <a href="{{ route('admin.generate-schedule') }}">
        <span class="icon">🔄</span> Generate Schedule
    </a>
    
    <div class="nav-label">Account</div>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-link">
        <span class="icon">🚪</span> Logout
    </a>
    
    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>

<!-- Main Content -->
<main class="main-content">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>@yield('header', 'Dashboard')</h1>
            <p class="subtitle">@yield('subtitle', 'Welcome back, Admin!')</p>
        </div>
        <div>
            @yield('actions')
        </div>
    </div>
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: rgba(34, 197, 94, 0.12); border: 1px solid rgba(34,197,94,0.15); border-radius: 12px; padding: 14px 20px; color: #6ee7b7; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239,68,68,0.15); border-radius: 12px; padding: 14px 20px; color: #fca5a5; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div style="background: rgba(99, 102, 241, 0.12); border: 1px solid rgba(99,102,241,0.15); border-radius: 12px; padding: 14px 20px; color: #a5b4fc; margin-bottom: 20px;">
            {{ session('info') }}
        </div>
    @endif
    
    <div class="content-area">
        @yield('content')
    </div>
</main>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('active');
    }
    
    // Close sidebar on resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('active');
        }
    });
</script>

@yield('scripts')
</body>
</html>