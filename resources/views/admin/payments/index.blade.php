<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Management - Admin</title>
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
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #f5f3ed 100%);
            min-height: 100vh;
        }
        .management-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .table {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .table thead {
            background: linear-gradient(135deg, var(--phthalo-green) 0%, var(--space-sparkle) 100%);
            color: white;
        }
        .table tbody tr:hover { background-color: #f9f9f9; }
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="management-header">
            <h2 style="color: var(--phthalo-green); font-weight: bold;">Payments Management</h2>
            <a href="{{ route('payments.create') }}" class="btn btn-lg" style="background-color: var(--phthalo-green); color: white;">
                <i class="bi bi-plus-circle me-2"></i>Record Payment
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($payments->count())
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Grade</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->payment_id }}</td>
                            <td>{{ $payment->student->full_name ?? 'N/A' }}</td>
                            <td>Grade {{ $payment->grade->grade_number ?? 'N/A' }} - {{ $payment->grade->section->class_name ?? 'N/A' }}</td>
                            <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                            <td>${{ number_format($payment->payment_amount, 2) }}</td>
                            <td>
                                <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this payment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $payments->links() }}</div>
        @else
            <div class="empty-state">
                <i class="bi bi-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; color: #d1d5db;"></i>
                <p>No payments found.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>