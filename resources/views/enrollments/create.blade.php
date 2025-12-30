<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Enroll Child - {{ config('app.name', 'Laravel') }}</title>

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

        .enrollment-container {
            max-width: 700px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .enrollment-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .enrollment-header {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 50%, var(--moonstone-blue) 100%);
            padding: 2.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .enrollment-header::before {
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

        .enrollment-header-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .enrollment-header h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .enrollment-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.95;
            font-size: 1rem;
        }

        .enrollment-body {
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--phthalo-green);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: #111827;
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

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e5e7eb;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Figtree', sans-serif;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--mustard-green) 100%);
            color: white;
            position: relative;
            overflow: hidden;
            flex: 1;
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
            background: white;
            color: #111827;
            border: 2px solid #e5e7eb;
            flex: 1;
        }

        .btn-secondary:hover {
            border-color: var(--mustard-green);
            color: var(--mustard-green);
            background: #f9fafb;
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

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-group.has-error .form-control {
            border-color: #dc2626;
        }

        @media (max-width: 768px) {
            .enrollment-container {
                margin: 1rem auto;
            }

            .enrollment-header {
                padding: 1.5rem;
            }

            .enrollment-header h1 {
                font-size: 1.5rem;
            }

            .enrollment-body {
                padding: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
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
    <div class="enrollment-container">
        <a href="{{ route('dashboard') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="enrollment-card">
            <div class="enrollment-header">
                <div class="enrollment-header-content">
                    <div>
                        <h1>
                            <i class="bi bi-file-earmark-plus"></i>
                            Enroll Your Child
                        </h1>
                        <p>Get your child started with us today</p>
                    </div>
                </div>
            </div>

            <div class="enrollment-body">
                @if ($errors->any())
                    <div class="alert" style="background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; margin-bottom: 1.5rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ url('/enroll') }}" method="POST">
                    @csrf
                    <input type="hidden" name="create_student" value="true">

                    <!-- Student Information Section -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="bi bi-person-fill" style="color: var(--mustard-green);"></i>
                            Child's Information
                        </h3>

                        <div class="form-group @error('full_name') has-error @enderror">
                            <label for="full_name" class="form-label">Full Name *</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="full_name" 
                                name="full_name" 
                                value="{{ old('full_name') }}"
                                required
                            >
                            @error('full_name')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('birth_date') has-error @enderror">
                            <label for="birth_date" class="form-label">Date of Birth *</label>
                            <input 
                                type="date" 
                                class="form-control" 
                                id="birth_date" 
                                name="birth_date" 
                                value="{{ old('birth_date') }}"
                                required
                            >
                            @error('birth_date')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('gender') has-error @enderror">
                            <label for="gender" class="form-label">Gender *</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">-- Select Gender --</option>
                                <option value="male" @selected(old('gender') === 'male')>Male</option>
                                <option value="female" @selected(old('gender') === 'female')>Female</option>
                            </select>
                            @error('gender')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('address') has-error @enderror">
                            <label for="address" class="form-label">Address *</label>
                            <textarea 
                                class="form-control" 
                                id="address" 
                                name="address" 
                                rows="3" 
                                required
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('notes') has-error @enderror">
                            <label for="notes" class="form-label">Extra Notes</label>
                            <textarea 
                                class="form-control" 
                                id="notes" 
                                name="notes" 
                                rows="2"
                            >{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Guardian Information Section -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="bi bi-person-check-fill" style="color: var(--space-sparkle);"></i>
                            Guardian Information
                        </h3>

                        <div class="form-group @error('guardian_full_name') has-error @enderror">
                            <label for="guardian_full_name" class="form-label">Full Name *</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="guardian_full_name" 
                                name="guardian_full_name" 
                                value="{{ old('guardian_full_name', auth()->user()->full_name) }}"
                                required
                            >
                            @error('guardian_full_name')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('guardian_email') has-error @enderror">
                            <label for="guardian_email" class="form-label">Email *</label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="guardian_email" 
                                name="guardian_email" 
                                value="{{ old('guardian_email', auth()->user()->email) }}"
                                required
                            >
                            @error('guardian_email')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('guardian_phone_number') has-error @enderror">
                            <label for="guardian_phone_number" class="form-label">Phone Number *</label>
                            <input 
                                type="tel" 
                                class="form-control" 
                                id="guardian_phone_number" 
                                name="guardian_phone_number" 
                                value="{{ old('guardian_phone_number') }}"
                                required
                            >
                            @error('guardian_phone_number')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group @error('relationship') has-error @enderror">
                            <label for="relationship" class="form-label">Relationship to Child *</label>
                            <select class="form-control" id="relationship" name="relationship" required>
                                <option value="">-- Select Relationship --</option>
                                <option value="Mother" @selected(old('relationship') === 'Mother')>Mother</option>
                                <option value="Father" @selected(old('relationship') === 'Father')>Father</option>
                                <option value="Guardian" @selected(old('relationship') === 'Guardian')>Guardian</option>
                                <option value="Aunt/Uncle" @selected(old('relationship') === 'Aunt/Uncle')>Aunt/Uncle</option>
                                <option value="Grandparent" @selected(old('relationship') === 'Grandparent')>Grandparent</option>
                                <option value="Other" @selected(old('relationship') === 'Other')>Other</option>
                            </select>
                            @error('relationship')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <div>
                                <strong>Note:</strong> The guardian's address will be set to the same as the child's address.
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Information Section -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="bi bi-book-fill" style="color: var(--space-sparkle);"></i>
                            Select Program
                        </h3>

                        <div class="form-group @error('program') has-error @enderror">
                            <label for="program" class="form-label">Program *</label>
                            <select class="form-control" id="program" name="program" required>
                                <option value="">-- Choose a program --</option>
                                <option value="nursery" @selected(old('program') === 'nursery')>Nursery</option>
                                <option value="kindergarten_1" @selected(old('program') === 'kindergarten_1')>Kindergarten 1</option>
                                <option value="kindergarten_2" @selected(old('program') === 'kindergarten_2')>Kindergarten 2</option>
                            </select>
                            @error('program')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <div>
                                <strong>Important:</strong> You are selecting a program for your child. The administrator will assign them to a specific class after your enrollment request is approved.
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            Submit Enrollment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
