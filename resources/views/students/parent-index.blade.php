<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Children - {{ config('app.name', 'Laravel') }}</title>

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

        body {
            background: #f9fafb;
            font-family: 'Figtree', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--phthalo-green);
            font-weight: 800;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--mustard-green) 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(26, 77, 10, 0.3);
        }

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

        .badge {
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

        .btn-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
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

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--phthalo-green);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 0.75rem;
            color: var(--mustard-green);
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
        <a href="{{ route('dashboard') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="header">
            <h1>My Children</h1>
            <a href="{{ route('enroll-child') }}" class="btn-primary">
                <i class="bi bi-plus-circle"></i>
                Add Child
            </a>
        </div>

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
                            <div class="info-label">Program</div>
                            <div class="info-value">{{ ucfirst(str_replace('_', ' ', $student->program)) }}</div>
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
                                                <span class="badge badge-pending">Pending</span>
                                            @elseif($enrollment->status === 'enrolled')
                                                <span class="badge badge-enrolled">Enrolled</span>
                                            @else
                                                <span class="badge badge-rejected">Declined</span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($enrollment->status === 'withdrawn' && $enrollment->decline_reason)
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
                        <a href="{{ route('students.edit-parent', $student->student_id) }}" class="btn btn-secondary">
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
                <p class="small">Click "Add Child" above to add and enroll your child.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>