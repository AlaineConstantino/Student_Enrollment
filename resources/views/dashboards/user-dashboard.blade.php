<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Parent Dashboard - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <style>
        :root {
            --phthalo-green: #1a4d0a;
            --mustard-green: #7a9c3a;
            --light-gray: #e8e6df;
            --space-sparkle: #4a8284;
            --moonstone-blue: #7dbdd1;
        }

        /* Container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        /* Welcome Section */
        .welcome-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .welcome-gradient {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 50%, var(--moonstone-blue) 100%);
            padding: 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .welcome-gradient::before {
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

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-content h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .welcome-content p {
            font-size: 1.25rem;
            opacity: 0.95;
            font-weight: 300;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 1rem;
            padding: 1.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 5px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
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

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            margin-bottom: 1rem;
            transition: all 0.4s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-icon i {
            font-size: 3rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 600;
        }

        .stat-card-1 {
            border-left-color: var(--mustard-green);
        }
        .stat-card-1 .stat-icon {
            background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.05) 100%);
        }
        .stat-card-1 .stat-icon i {
            color: var(--mustard-green);
        }
        .stat-card-1 .stat-number {
            color: var(--mustard-green);
        }

        .stat-card-2 {
            border-left-color: #f59e0b;
        }
        .stat-card-2 .stat-icon {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0.05) 100%);
        }
        .stat-card-2 .stat-icon i {
            color: #f59e0b;
        }
        .stat-card-2 .stat-number {
            color: #f59e0b;
        }

        .stat-card-3 {
            border-left-color: #10b981;
        }
        .stat-card-3 .stat-icon {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.05) 100%);
        }
        .stat-card-3 .stat-icon i {
            color: #10b981;
        }
        .stat-card-3 .stat-number {
            color: #10b981;
        }

        /* Section Header */
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-icon {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            margin-right: 1rem;
        }

        .section-icon i {
            font-size: 1.875rem;
        }

        .section-title {
            font-size: 1.875rem;
            font-weight: 800;
            color: #111827;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, var(--mustard-green), transparent);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .action-card {
            background: white;
            border: 2px solid transparent;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .action-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--mustard-green), var(--space-sparkle));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            border-color: var(--mustard-green);
        }

        .action-card:hover::after {
            transform: scaleX(1);
        }

        .action-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            transition: all 0.4s ease;
        }

        .action-card:hover .action-icon {
            transform: scale(1.1);
        }

        .action-icon i {
            font-size: 2.5rem;
        }

        .action-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .action-desc {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Student Card */
        .student-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--phthalo-green);
            transition: all 0.4s ease;
        }

        .student-card:hover {
            transform: translateX(4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .student-card h5 {
            color: var(--phthalo-green);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .student-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            padding: 1rem;
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            border-color: var(--mustard-green);
            box-shadow: 0 4px 12px rgba(122, 156, 58, 0.1);
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1rem;
            color: #111827;
            font-weight: 600;
        }

        /* Enrollment Section */
        .enrollment-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #e5e7eb;
        }

        .enrollment-header {
            color: var(--space-sparkle);
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .enrollment-list {
            display: grid;
            gap: 0.75rem;
        }

        .enrollment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .enrollment-item:hover {
            border-color: var(--space-sparkle);
            box-shadow: 0 4px 12px rgba(74, 130, 132, 0.1);
        }

        .enrollment-info strong {
            color: #111827;
            font-size: 1.125rem;
        }

        .enrollment-meta {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        /* Badges */
        .enrollment-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 700;
        }

        .badge-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .badge-enrolled {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .badge-rejected {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        /* Buttons */
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
            color: white;
        }

        .btn-secondary {
            background-color: white;
            color: #6b7280;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background-color: #f9fafb;
            border-color: var(--mustard-green);
            color: var(--phthalo-green);
            transform: translateY(-2px);
        }

        .btn-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        /* Tab Styles */
        .tabs-container {
            margin-bottom: 2rem;
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tab-button {
            padding: 1rem 1.5rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            color: #6b7280;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            top: 2px;
        }

        .tab-button:hover {
            color: var(--phthalo-green);
        }

        .tab-button.active {
            color: var(--phthalo-green);
            border-bottom-color: var(--phthalo-green);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #6b7280;
            font-size: 1.125rem;
            margin: 0.5rem 0;
        }

        .empty-state p.small {
            font-size: 0.9rem;
            color: #9ca3af;
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 100%);
            color: white;
        }

        .table th,
        .table td {
            padding: 1.25rem 1.5rem;
            text-align: left;
        }

        .table th {
            font-weight: 700;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table td {
            color: #374151;
        }

        .table td strong {
            color: #111827;
            font-weight: 600;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 1rem;
        }

        .modal.show {
            display: flex;
        }

        .modal-dialog {
            background: white;
            border-radius: 1rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .btn-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-close:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

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

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            .welcome-content h1 {
                font-size: 2rem;
            }

            .welcome-content p {
                font-size: 1rem;
            }

            .stats-grid,
            .quick-actions {
                grid-template-columns: 1fr;
            }

            .student-info {
                grid-template-columns: 1fr;
            }

            .enrollment-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-actions {
                flex-direction: column;
            }

            .btn-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">Bright Minds Kindergarten</a>
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
                    <h1>
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                        Welcome, {{ Auth::user()->full_name }}!
                    </h1>
                    <p>Manage your children's enrollment and academic information</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card stat-card-1">
                <div class="stat-card-content">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-number">{{ $students->count() }}</div>
                    <div class="stat-label">My Children</div>
                </div>
            </div>

            <div class="stat-card stat-card-2">
                <div class="stat-card-content">
                    <div class="stat-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-number">{{ $pendingEnrollments }}</div>
                    <div class="stat-label">Pending Enrollments</div>
                </div>
            </div>

            <div class="stat-card stat-card-3">
                <div class="stat-card-content">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="stat-number">{{ $approvedEnrollments }}</div>
                    <div class="stat-label">Approved</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="section-header">
            <div class="section-icon" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.05) 100%);">
                <i class="bi bi-lightning-fill" style="color: var(--mustard-green);"></i>
            </div>
            <h2 class="section-title">Quick Actions</h2>
        </div>
        <div class="quick-actions">
            <a href="{{ route('enroll-child') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.05) 100%);">
                    <i class="bi bi-file-earmark-plus" style="color: var(--mustard-green);"></i>
                </div>
                <div class="action-title">Enroll Child</div>
                <div class="action-desc">Add and enroll your child</div>
            </a>
            <a href="#my-students" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.05) 100%);">
                    <i class="bi bi-people" style="color: var(--mustard-green);"></i>
                </div>
                <div class="action-title">My Children</div>
                <div class="action-desc">View and manage children</div>
            </a>
            <a href="#enrollments" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, rgba(74, 130, 132, 0.15) 0%, rgba(74, 130, 132, 0.05) 100%);">
                    <i class="bi bi-file-earmark-check" style="color: var(--space-sparkle);"></i>
                </div>
                <div class="action-title">Enrollments</div>
                <div class="action-desc">Check enrollment status</div>
            </a>
        </div>

        <!-- My Children Section with Tabs -->
        <div id="my-students" style="margin-bottom: 3rem;">
            <div class="section-header">
                <div class="section-icon" style="background: linear-gradient(135deg, rgba(122, 156, 58, 0.15) 0%, rgba(122, 156, 58, 0.05) 100%);">
                    <i class="bi bi-people-fill" style="color: var(--mustard-green);"></i>
                </div>
                <h2 class="section-title">My Children</h2>
            </div>

            <div class="tabs-container">
                <!-- Tab Buttons -->
                <div class="tab-buttons">
                    <button class="tab-button active" onclick="switchTab(event, 'active-tab')">
                        <i class="bi bi-person-fill"></i>
                        Active Children
                        <span style="background: var(--mustard-green); color: white; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; margin-left: 0.5rem;">{{ $students->count() }}</span>
                    </button>
                    @php
                        $archivedStudents = \App\Models\Student::onlyTrashed()
                            ->whereHas('guardian', function ($query) {
                                $query->where('email', Auth::user()->email);
                            })->get();
                    @endphp
                    @if($archivedStudents->count())
                        <button class="tab-button" onclick="switchTab(event, 'archived-tab')">
                            <i class="bi bi-archive"></i>
                            Archived Children
                            <span style="background: #6b7280; color: white; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; margin-left: 0.5rem;">{{ $archivedStudents->count() }}</span>
                        </button>
                    @endif
                </div>

                <!-- Active Children Tab -->
                <div id="active-tab" class="tab-content active">
                    @if($students->count())
                        @foreach($students as $student)
                            <div class="student-card">
                                <h5>
                                    <i class="bi bi-person-fill"></i>
                                    {{ $student->full_name }}
                                </h5>

                                <div class="student-info">
                                    <div class="info-item">
                                        <div class="info-label">Date of Birth</div>
                                        <div class="info-value">{{ $student->birth_date->format('M d, Y') }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Age</div>
                                        <div class="info-value">{{ $student->age }} years</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Gender</div>
                                        <div class="info-value">{{ ucfirst($student->gender) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Address</div>
                                        <div class="info-value" title="{{ $student->address }}">{{ strlen($student->address) > 30 ? substr($student->address, 0, 30) . '...' : $student->address }}</div>
                                    </div>
                                </div>

                                <!-- Enrollments for this student -->
                                @php
                                    $enrollments = \App\Models\Enrollment::where('student_id', $student->student_id)->get();
                                @endphp

                                @if($enrollments->count())
                                    <div class="enrollment-section">
                                        <h6 class="enrollment-header">
                                            <i class="bi bi-list-check"></i>
                                            Enrollment Status
                                        </h6>
                                        <div class="enrollment-list">
                                            @foreach($enrollments as $enrollment)
                                                <div class="enrollment-item">
                                                    <div class="enrollment-info">
                                                        <strong>{{ $enrollment->classModel->class_name ?? 'Class' }}</strong>
                                                        <div class="enrollment-meta">
                                                            Age Range: {{ $enrollment->classModel->age_range ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        @if($enrollment->status === 'pending')
                                                            <span class="enrollment-badge badge-pending">Pending</span>
                                                        @elseif($enrollment->status === 'enrolled')
                                                            <span class="enrollment-badge badge-enrolled">Enrolled</span>
                                                        @else
                                                            <span class="enrollment-badge badge-rejected">Declined</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                @if($enrollment->status === 'rejected' && $enrollment->decline_reason)
                                                    <div style="margin-top: 1rem; padding: 1rem; background: #fef2f2; border-left: 3px solid #dc2626; border-radius: 0.5rem;">
                                                        <p style="color: #991b1b; margin: 0; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">
                                                            <i class="bi bi-exclamation-circle"></i> Decline Reason:
                                                        </p>
                                                        <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">{{ $enrollment->decline_reason }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="enrollment-section">
                                        <p style="color: #6b7280; font-size: 0.9rem; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="bi bi-info-circle"></i>
                                            No enrollments yet
                                        </p>
                                    </div>
                                @endif

                                <div class="btn-actions">
                                    <a href="{{ route('students.edit-parent', $student->student_id) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil"></i>
                                        Edit Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <i class="bi bi-person-x"></i>
                            <p>No children registered yet.</p>
                            <p class="small">Click "Enroll Child" in the quick actions above to add and enroll your child.</p>
                        </div>
                    @endif
                </div>

                <!-- Archived Children Tab -->
                @if($archivedStudents->count())
                    <div id="archived-tab" class="tab-content">
                        @foreach($archivedStudents as $student)
                            <div class="student-card" style="border-left-color: #9ca3af; opacity: 0.85;">
                                <h5 style="color: #6b7280;">
                                    <i class="bi bi-person-fill"></i>
                                    {{ $student->full_name }}
                                    <span style="font-size: 0.75rem; background: #f3f4f6; color: #6b7280; padding: 0.25rem 0.75rem; border-radius: 9999px; margin-left: 0.5rem;">Archived</span>
                                </h5>

                                <div class="student-info">
                                    <div class="info-item">
                                        <div class="info-label">Date of Birth</div>
                                        <div class="info-value">{{ $student->birth_date->format('M d, Y') }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Age</div>
                                        <div class="info-value">{{ $student->age }} years</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Gender</div>
                                        <div class="info-value">{{ ucfirst($student->gender) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Program</div>
                                        <div class="info-value">{{ ucfirst(str_replace('_', ' ', $student->program ?? 'N/A')) }}</div>
                                    </div>
                                </div>

                                <div class="btn-actions">
                                    <form action="{{ route('students.restore-parent', $student->student_id) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Restore Child
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Enrollments Summary Section -->
        <div id="enrollments">
            <div class="section-header">
                <div class="section-icon" style="background: linear-gradient(135deg, rgba(74, 130, 132, 0.15) 0%, rgba(74, 130, 132, 0.05) 100%);">
                    <i class="bi bi-file-earmark-check" style="color: var(--space-sparkle);"></i>
                </div>
                <h2 class="section-title">Enrollment Summary</h2>
            </div>

            @php
                $allEnrollments = \App\Models\Enrollment::whereIn('student_id', $students->pluck('student_id'))->get();
            @endphp

            @if($allEnrollments->count())
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Child Name</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Applied</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allEnrollments as $enrollment)
                                <tr>
                                    <td><strong>{{ $enrollment->student->full_name }}</strong></td>
                                    <td>{{ $enrollment->classModel->class_name ?? 'N/A' }}</td>
                                    <td>
                                        @if($enrollment->status === 'pending')
                                            <span class="enrollment-badge badge-pending">Pending</span>
                                        @elseif($enrollment->status === 'enrolled')
                                            <span class="enrollment-badge badge-enrolled">Enrolled</span>
                                        @else
                                            <span class="enrollment-badge badge-rejected">Declined</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($enrollment->status === 'rejected' && $enrollment->decline_reason)
                                            <small class="text-danger" title="{{ $enrollment->decline_reason }}">
                                                <i class="bi bi-exclamation-circle"></i> {{ substr($enrollment->decline_reason, 0, 50) }}{{ strlen($enrollment->decline_reason) > 50 ? '...' : '' }}
                                            </small>
                                        @else
                                            <small class="text-muted">—</small>
                                        @endif
                                    </td>
                                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>No enrollments yet.</p>
                    <p class="small">Click "Enroll in Class" on your children's cards to submit enrollment requests.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('show');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        function switchTab(event, tabId) {
            event.preventDefault();
            
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab and mark button as active
            document.getElementById(tabId).classList.add('active');
            event.target.closest('.tab-button').classList.add('active');
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal.show').forEach(modal => {
                    modal.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>