<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments Management - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --phthalo-green: #1a4d0a; --mustard-green: #7a9c3a; --light-gray: #e8e6df; --space-sparkle: #4a8284; --moonstone-blue: #7dbdd1; }
        body { font-family: 'Figtree', sans-serif; background: linear-gradient(135deg, var(--light-gray) 0%, #f5f3ed 100%); min-height: 100vh; }
        .management-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .search-box { max-width: 400px; }
        .nav-tabs .nav-link { color: var(--phthalo-green); border: none; border-bottom: 3px solid transparent; font-weight: 600; }
        .nav-tabs .nav-link.active { background: none; color: var(--phthalo-green); border-bottom-color: var(--phthalo-green); }
        .table { background: white; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .table thead { background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 100%); color: white; }
        .table tbody tr:hover { background-color: #f9f9f9; }
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-enrolled { background-color: #198754; }
        .badge-withdrawn { background-color: #dc3545; }
        .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.85rem; }
        .empty-state { text-align: center; padding: 3rem; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="management-header">
            <div>
                <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--phthalo-green); text-decoration: none; font-weight: 600; margin-bottom: 1rem;">
                    <i class="bi bi-arrow-left"></i>
                    Back to Dashboard
                </a>
                <h2 style="color: var(--phthalo-green); font-weight: bold; margin: 0;">Enrollments Management</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="{{ route('enrollments.index') }}" class="search-box">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by student or guardian..." value="{{ request('search') }}">
                        <button class="btn" type="submit" style="background-color: var(--phthalo-green); color: white;"><i class="bi bi-search"></i> Search</button>
                    </div>
                </form>
            </div>
        </div>

        <ul class="nav nav-tabs mb-4" role="tablist">
            <li class="nav-item"><button class="nav-link @if(!request('archived')) active @endif" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab"><i class="bi bi-check-circle me-2"></i>Active</button></li>
            <li class="nav-item"><button class="nav-link @if(request('archived')) active @endif" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab"><i class="bi bi-archive me-2"></i>Archived</button></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade @if(!request('archived')) show active @endif" id="active" role="tabpanel">
                @if($enrollments->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead><tr><th>#</th><th>Student</th><th>Guardian</th><th>Class</th><th>Status</th><th>Applied</th><th>Actions</th></tr></thead>
                            <tbody>
                                @foreach($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->id }}</td>
                                    <td>{{ $enrollment->student->full_name ?? 'N/A' }}</td>
                                    <td>{{ $enrollment->student->guardian->full_name ?? 'N/A' }}</td>
                                    <td>{{ $enrollment->classModel->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($enrollment->status === 'pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @elseif($enrollment->status === 'enrolled')
                                            <span class="badge badge-enrolled">Enrolled</span>
                                        @else
                                            <span class="badge badge-withdrawn">Withdrawn</span>
                                        @endif
                                    </td>
                                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('enrollments.edit', $enrollment->enrollment_id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                            Review & Decide
                                        </a>
                                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Archive?');">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-warning"><i class="bi bi-archive"></i> Archive</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $enrollments->links() }}</div>
                @else
                    <div class="empty-state"><i class="bi bi-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; color: #d1d5db;"></i><p>No active enrollments found.</p></div>
                @endif
            </div>

            <div class="tab-pane fade @if(request('archived')) show active @endif" id="archived" role="tabpanel">
                @if($archived && $archived->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead><tr><th>#</th><th>Student</th><th>Guardian</th><th>Class</th><th>Status</th><th>Archived</th><th>Actions</th></tr></thead>
                            <tbody>
                                @foreach($archived as $enrollment)
                                <tr style="opacity: 0.7;">
                                    <td>{{ $enrollment->id }}</td>
                                    <td>{{ $enrollment->student->full_name ?? 'N/A' }}</td>
                                    <td>{{ $enrollment->student->guardian->full_name ?? 'N/A' }}</td>
                                    <td>{{ $enrollment->classModel->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($enrollment->status === 'pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @elseif($enrollment->status === 'enrolled')
                                            <span class="badge badge-enrolled">Enrolled</span>
                                        @else
                                            <span class="badge badge-withdrawn">Withdrawn</span>
                                        @endif
                                    </td>
                                    <td>{{ $enrollment->deleted_at->format('M d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('enrollments.restore', $enrollment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Restore?');">@csrf<button type="submit" class="btn btn-sm btn-outline-success"><i class="bi bi-arrow-counterclockwise"></i> Restore</button></form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state"><i class="bi bi-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; color: #d1d5db;"></i><p>No archived enrollments.</p></div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>