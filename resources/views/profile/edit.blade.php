<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --phthalo-green: #1a4d0a;
            --mustard-green: #7a9c3a;
            --light-gray: #e8e6df;
            --space-sparkle: #4a8284;
            --moonstone-blue: #7dbdd1;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #f5f3ed 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 3rem;
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            list-style: none;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .dropdown {
            position: relative;
        }

        .dropdown::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 8px;
            pointer-events: auto;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            cursor: pointer;
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-family: 'Figtree', sans-serif;
        }

        .dropdown-toggle:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 12rem;
            display: none;
            z-index: 1000;
            pointer-events: auto;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #374151;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Figtree', sans-serif;
            font-size: 0.95rem;
        }

        .dropdown-item:first-child {
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .dropdown-item:last-child {
            border-radius: 0 0 0.75rem 0.75rem;
        }

        .dropdown-item:hover {
            background-color: var(--light-gray);
            color: var(--phthalo-green);
        }

        /* Container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        /* Welcome Header */
        .profile-header {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .profile-gradient {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 50%, var(--moonstone-blue) 100%);
            padding: 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .profile-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        .profile-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .profile-info h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .profile-info p {
            font-size: 1.25rem;
            opacity: 0.95;
            font-weight: 300;
        }

        .profile-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 1rem;
        }

        .profile-icon i {
            font-size: 4rem;
        }

        /* Grid Layouts */
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Info Cards */
        .info-card {
            background: white;
            border-radius: 1rem;
            padding: 1.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.5) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .info-card:hover::before {
            opacity: 1;
        }

        .info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .info-card-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .info-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            flex-shrink: 0;
            transition: all 0.4s ease;
        }

        .info-card:hover .info-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .info-icon i {
            font-size: 2.5rem;
        }

        .info-details {
            flex: 1;
        }

        .info-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }

        /* Section Cards */
        .section-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .section-card:hover {
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .section-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-header i {
            font-size: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
        }

        .section-body {
            padding: 1.5rem;
        }

        /* Privilege Tags */
        .privilege-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .privilege-tag {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .privilege-tag:hover {
            transform: translateY(-2px);
        }

        .tag-green {
            background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.08) 100%);
            color: var(--mustard-green);
        }

        /* Danger Zone */
        .danger-card {
            border-left: 5px solid #dc2626;
        }

        .danger-card .section-header {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.08) 0%, transparent 100%);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-family: 'Figtree', sans-serif;
            color: #111827;
            background-color: #ffffff;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--mustard-green);
            box-shadow: 0 0 0 3px rgba(122, 156, 58, 0.1);
        }

        .form-control:hover {
            border-color: #d1d5db;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Figtree', sans-serif;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--mustard-green) 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(26, 77, 10, 0.3);
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.3);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        .text-muted {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            line-height: 1.5;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .profile-icon {
                display: none;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            .profile-info h1 {
                font-size: 2rem;
            }

            .profile-info p {
                font-size: 1rem;
            }

            .grid-3 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-brand">Kindergarten System</a>
            <ul class="navbar-nav">
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="bi bi-house-fill"></i>
                        Dashboard
                    </a>
                </li>
                <li class="dropdown">
                    <button class="dropdown-toggle">
                        <i class="bi bi-person-circle"></i>
                        {{ auth()->user()->full_name }}
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="bi bi-person me-2"></i>Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-gradient">
                <div class="profile-content">
                    <div class="profile-info">
                        <h1>
                            @if(auth()->user()->role === 'admin')
                                {{ auth()->user()->full_name }} - Administrator
                            @elseif(auth()->user()->role === 'teacher')
                                {{ auth()->user()->full_name }} - Educator
                            @else
                                {{ auth()->user()->full_name }} - Parent/User
                            @endif
                        </h1>
                        <p>Manage your account settings and preferences</p>
                    </div>
                    <div class="profile-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role-Specific Sections (Moved up) -->
        @if(auth()->user()->role === 'admin')
        <div class="section-card" style="margin-bottom: 2rem;">
            <div class="section-header">
                <i class="bi bi-shield-lock" style="color: var(--phthalo-green);"></i>
                <h3 class="section-title">Administrator Privileges</h3>
            </div>
            <div class="section-body">
                <div style="margin-bottom: 1rem;">
                    <p style="font-weight: 600; color: #6b7280; margin-bottom: 1rem;">System Access</p>
                    <div class="privilege-tags">
                        <span class="privilege-tag tag-green">
                            <i class="bi bi-check-circle-fill"></i>
                            Students Management
                        </span>
                        <span class="privilege-tag tag-green">
                            <i class="bi bi-check-circle-fill"></i>
                            Teachers Management
                        </span>
                        <span class="privilege-tag tag-green">
                            <i class="bi bi-check-circle-fill"></i>
                            Classes Management
                        </span>
                        <span class="privilege-tag tag-green">
                            <i class="bi bi-check-circle-fill"></i>
                            Enrollments Management
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @elseif(auth()->user()->role === 'teacher')
        <div class="section-card" style="margin-bottom: 2rem;">
            <div class="section-header">
                <i class="bi bi-person-video3" style="color: var(--moonstone-blue);"></i>
                <h3 class="section-title">Educator Information</h3>
            </div>
            <div class="section-body">
                <p style="color: #6b7280; line-height: 1.6;">You have access to manage classroom activities and student progress.</p>
            </div>
        </div>
        @else
        <div class="section-card" style="margin-bottom: 2rem;">
            <div class="section-header">
                <i class="bi bi-people-fill" style="color: var(--mustard-green);"></i>
                <h3 class="section-title">Parent/User Access</h3>
            </div>
            <div class="section-body">
                <p style="color: #6b7280; line-height: 1.6;">You can manage student enrollments and view school information.</p>
            </div>
        </div>
        @endif

        <!-- Account Information Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Account Role -->
            <div class="info-card">
                <div class="info-card-content">
                    <div class="info-icon" style="background: linear-gradient(135deg, rgba(26, 77, 10, 0.15) 0%, rgba(26, 77, 10, 0.05) 100%);">
                        <i class="bi bi-person-circle" style="color: var(--phthalo-green);"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Account Role</div>
                        <div class="info-value">
                            @if(auth()->user()->role === 'admin')
                                Admin
                            @elseif(auth()->user()->role === 'teacher')
                                Teacher
                            @else
                                {{ ucfirst(auth()->user()->role) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Member Since -->
            <div class="info-card">
                <div class="info-card-content">
                    <div class="info-icon" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.05) 100%);">
                        <i class="bi bi-calendar-event" style="color: var(--mustard-green);"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Member Since</div>
                        <div class="info-value">{{ auth()->user()->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Management -->
        <div class="grid-2">
            <!-- Update Profile Information -->
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-person-fill" style="color: var(--phthalo-green);"></i>
                    <h3 class="section-title">Profile Information</h3>
                </div>
                <div class="section-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="section-card">
                <div class="section-header">
                    <i class="bi bi-lock-fill" style="color: var(--space-sparkle);"></i>
                    <h3 class="section-title">Security</h3>
                </div>
                <div class="section-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete Account Section -->
        @if(auth()->user()->role !== 'admin')
        <div class="section-card danger-card">
            <div class="section-header">
                <i class="bi bi-trash-fill" style="color: #dc2626;"></i>
                <h3 class="section-title">Danger Zone</h3>
            </div>
            <div class="section-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        @endif
    </div>
</body>

</html>