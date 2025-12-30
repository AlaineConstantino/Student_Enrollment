<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Review Enrollment - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
        
        .container-fluid {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 100%);
            color: white;
            border: none;
            border-radius: 1rem 1rem 0 0;
            padding: 1.5rem;
        }
        
        .card-header h3 {
            margin: 0;
            font-weight: 700;
        }
        
        .info-section {
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--mustard-green);
        }
        
        .info-section h5 {
            color: var(--phthalo-green);
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .info-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .info-item {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
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
        
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 700;
        }
        
        .badge-pending {
            background: #ffc107;
            color: #000;
        }
        
        .form-section {
            padding: 1.5rem;
            background: white;
        }
        
        .form-section h5 {
            color: var(--phthalo-green);
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-family: 'Figtree', sans-serif;
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
        
        .btn {
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Figtree', sans-serif;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            color: white;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border: none;
            color: white;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            color: white;
        }
        
        .btn-secondary {
            background: white;
            border: 2px solid #e5e7eb;
            color: #6b7280;
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
            border-color: var(--mustard-green);
            color: var(--phthalo-green);
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e5e7eb;
            flex-wrap: wrap;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--phthalo-green);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .back-link:hover {
            color: var(--mustard-green);
        }
        
        .alert {
            border: none;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <a href="{{ route('enrollments.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Enrollments
        </a>
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <!-- Student & Enrollment Info -->
        <div class="card">
            <div class="card-header">
                <h3>
                    <i class="bi bi-clipboard-check"></i>
                    Review Enrollment Application
                </h3>
            </div>
            
            <div class="form-section">
                <!-- Student Information -->
                <div class="info-section">
                    <h5>
                        <i class="bi bi-person-fill"></i>
                        Student Information
                    </h5>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $enrollment->student->full_name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date of Birth</div>
                            <div class="info-value">{{ $enrollment->student->birth_date->format('M d, Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Age</div>
                            <div class="info-value">{{ $enrollment->student->age }} years</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Gender</div>
                            <div class="info-value">{{ ucfirst($enrollment->student->gender) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Program</div>
                            <div class="info-value">{{ ucfirst(str_replace('_', ' ', $enrollment->student->program)) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $enrollment->student->address }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Guardian Information -->
                <div class="info-section">
                    <h5>
                        <i class="bi bi-person-check-fill"></i>
                        Guardian Information
                    </h5>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $enrollment->student->guardian->full_name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $enrollment->student->guardian->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $enrollment->student->guardian->phone_number }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Relationship</div>
                            <div class="info-value">{{ $enrollment->student->guardian->relationship }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Enrollment Status -->
                <div class="info-section">
                    <h5>
                        <i class="bi bi-info-circle-fill"></i>
                        Current Status
                    </h5>
                    <div class="info-row">
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="status-badge badge-pending">
                                    <i class="bi bi-clock-history"></i>
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Applied On</div>
                            <div class="info-value">{{ $enrollment->created_at->format('M d, Y \a\t h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decision Form -->
        <div class="card">
            <div class="card-header">
                <h3>
                    <i class="bi bi-clipboard-check"></i>
                    Make Decision
                </h3>
            </div>
            
            <form method="POST" action="{{ route('enrollments.update', $enrollment->enrollment_id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Approve Section -->
                            <div style="padding: 1.5rem; background: #f0fdf4; border-radius: 0.75rem; border: 2px solid #dcfce7; margin-bottom: 2rem;">
                                <h5 style="color: #059669; margin-bottom: 1.5rem;">
                                    <i class="bi bi-check-circle"></i>
                                    Approve Enrollment
                                </h5>
                                
                                <div class="form-group">
                                    <label class="form-label">Select Class *</label>
                                    <select name="class_id" class="form-control" id="classSelect">
                                        <option value="">-- Choose a class --</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->class_id }}">
                                                {{ $class->class_name }} ({{ $class->age_range }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Enrollment Date</label>
                                    <input type="date" name="enrollment_date" class="form-control" value="{{ old('enrollment_date', now()->format('Y-m-d')) }}">
                                </div>
                                
                                <button type="submit" name="status" value="approved" class="btn btn-success w-100">
                                    <i class="bi bi-check-circle"></i>
                                    Approve & Assign to Class
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Decline Section -->
                            <div style="padding: 1.5rem; background: #fef2f2; border-radius: 0.75rem; border: 2px solid #fee2e2; margin-bottom: 2rem;">
                                <h5 style="color: #dc2626; margin-bottom: 1.5rem;">
                                    <i class="bi bi-x-circle"></i>
                                    Decline Enrollment
                                </h5>
                                
                                <div class="form-group">
                                    <label class="form-label">Reason for Decline *</label>
                                    <textarea name="decline_reason" class="form-control" placeholder="Provide a clear reason for declining this enrollment..." id="declineReason"></textarea>
                                    <small class="text-muted">This will be visible to the parent</small>
                                    @error('decline_reason')
                                        <small class="text-danger d-block mt-2">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <button type="submit" name="status" value="rejected" class="btn btn-danger w-100">
                                    <i class="bi bi-x-circle"></i>
                                    Decline Enrollment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validate form submission
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const status = this.getAttribute('value');
                
                if (status === 'approved') {
                    const classSelect = document.getElementById('classSelect');
                    if (!classSelect.value) {
                        e.preventDefault();
                        alert('Please select a class to approve this enrollment.');
                        return false;
                    }
                } else if (status === 'rejected') {
                    const declineReason = document.getElementById('declineReason');
                    if (!declineReason.value.trim()) {
                        e.preventDefault();
                        alert('Please provide a reason for declining this enrollment.');
                        return false;
                    }
                    if (declineReason.value.trim().length < 10) {
                        e.preventDefault();
                        alert('Please provide at least 10 characters for the decline reason.');
                        return false;
                    }
                }
            });
        });
    </script>
</body>
</html>
