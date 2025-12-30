<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-brand">Bright Minds Kindergarten</a>
            <ul class="navbar-nav">
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
        <!-- Welcome Section -->
        <div class="welcome-card">
            <div class="welcome-gradient">
                <div class="welcome-content">
                    <div class="welcome-text">
                        <h1>Welcome back, {{ auth()->user()->full_name }}!</h1>
                        <p>Manage your kindergarten enrollment system with ease and efficiency</p>
                    </div>
                    <div class="welcome-icon">
                        <i class="bi bi-emoji-smile"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid-4">
            <!-- Total Students -->
            <div class="stat-card stat-card-students">
                <div class="stat-card-content">
                    <div class="stat-info">
                        <div class="stat-label">Total Students</div>
                        <div class="stat-number">{{ $totalStudents ?? 0 }}</div>
                        <div class="stat-desc">Enrolled learners</div>
                    </div>
                    <div class="icon-wrapper">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>

            <!-- Total Teachers -->
            <div class="stat-card stat-card-teachers">
                <div class="stat-card-content">
                    <div class="stat-info">
                        <div class="stat-label">Total Teachers</div>
                        <div class="stat-number">{{ $totalTeachers ?? 0 }}</div>
                        <div class="stat-desc">Active educators</div>
                    </div>
                    <div class="icon-wrapper">
                        <i class="bi bi-person-video3"></i>
                    </div>
                </div>
            </div>

            <!-- Total Classes -->
            <div class="stat-card stat-card-classes">
                <div class="stat-card-content">
                    <div class="stat-info">
                        <div class="stat-label">Total Classes</div>
                        <div class="stat-number">{{ $totalClasses ?? 0 }}</div>
                        <div class="stat-desc">Active classrooms</div>
                    </div>
                    <div class="icon-wrapper">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Enrollments -->
            <div class="stat-card stat-card-enrollments">
                <div class="stat-card-content">
                    <div class="stat-info">
                        <div class="stat-label">Pending</div>
                        <div class="stat-number">{{ $pendingEnrollments ?? 0 }}</div>
                        <div class="stat-desc">Awaiting review</div>
                    </div>
                    <div class="icon-wrapper">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Management Section Header -->
        <div class="section-header">
            <div class="section-icon" style="background: linear-gradient(135deg, rgba(74, 130, 132, 0.15) 0%, rgba(74, 130, 132, 0.05) 100%);">
                <i class="bi bi-gear-fill" style="color: var(--space-sparkle);"></i>
            </div>
            <h3 class="section-title">System Management</h3>
        </div>

        <!-- Management Cards -->
        <div class="grid-2">
            <!-- Students Management -->
            <div class="management-card" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.08) 0%, rgba(255, 255, 255, 1) 50%);">
                <div class="management-header">
                    <div class="management-icon icon-wrapper" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.2) 0%, rgba(122, 156, 58, 0.1) 100%);">
                        <i class="bi bi-people-fill" style="color: var(--mustard-green); font-size: 1.875rem;"></i>
                    </div>
                    <div>
                        <h3 class="management-title">Students Management</h3>
                        <p class="management-desc">Manage all student records, profiles, enrollment status, and academic information in one centralized location.</p>
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="btn-primary">
                    View All Students
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Teachers Management -->
            <div class="management-card" style="background: linear-gradient(135deg, rgba(125, 189, 209, 0.08) 0%, rgba(255, 255, 255, 1) 50%);">
                <div class="management-header">
                    <div class="management-icon icon-wrapper" style="background: linear-gradient(135deg, rgba(125, 189, 209, 0.2) 0%, rgba(125, 189, 209, 0.1) 100%);">
                        <i class="bi bi-person-video3" style="color: var(--moonstone-blue); font-size: 1.875rem;"></i>
                    </div>
                    <div>
                        <h3 class="management-title">Teachers Management</h3>
                        <p class="management-desc">Manage teacher profiles, classroom assignments, professional qualifications, and teaching schedules.</p>
                    </div>
                </div>
                <a href="{{ route('teachers.index') }}" class="btn-primary">
                    View All Teachers
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Classes Management -->
            <div class="management-card" style="background: linear-gradient(135deg, rgba(74, 130, 132, 0.08) 0%, rgba(255, 255, 255, 1) 50%);">
                <div class="management-header">
                    <div class="management-icon icon-wrapper" style="background: linear-gradient(135deg, rgba(74, 130, 132, 0.2) 0%, rgba(74, 130, 132, 0.1) 100%);">
                        <i class="bi bi-building" style="color: var(--space-sparkle); font-size: 1.875rem;"></i>
                    </div>
                    <div>
                        <h3 class="management-title">Classes Management</h3>
                        <p class="management-desc">Organize and manage classroom information, capacity limits, scheduling details, and room assignments.</p>
                    </div>
                </div>
                <a href="{{ route('classes.index') }}" class="btn-primary">
                    View All Classes
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Enrollments Management -->
            <div class="management-card" style="background: linear-gradient(135deg, rgba(26, 77, 10, 0.08) 0%, rgba(255, 255, 255, 1) 50%);">
                <div class="management-header">
                    <div class="management-icon icon-wrapper" style="background: linear-gradient(135deg, rgba(26, 77, 10, 0.2) 0%, rgba(26, 77, 10, 0.1) 100%);">
                        <i class="bi bi-clipboard-check" style="color: var(--phthalo-green); font-size: 1.875rem;"></i>
                    </div>
                    <div>
                        <h3 class="management-title">Enrollments Management</h3>
                        <p class="management-desc">Review and process enrollment applications, handle approvals, and manage student class placements.</p>
                    </div>
                </div>
                <a href="{{ route('enrollments.index') }}" class="btn-primary">
                    View Enrollments
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Users Management -->
            <div class="management-card" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.08) 0%, rgba(255, 255, 255, 1) 50%);">
                <div class="management-header">
                    <div class="management-icon icon-wrapper" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.2) 0%, rgba(122, 156, 58, 0.1) 100%);">
                        <i class="bi bi-person-gear" style="color: var(--mustard-green); font-size: 1.875rem;"></i>
                    </div>
                    <div>
                        <h3 class="management-title">Users Management</h3>
                        <p class="management-desc">Manage system users, assign roles, update permissions, and handle user accounts and credentials.</p>
                    </div>
                </div>
                <a href="{{ route('users.index') }}" class="btn-primary">
                    View All Users
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</body>

</html>