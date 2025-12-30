<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --phthalo-green: #1a4d0a; --light-gray: #e8e6df; --space-sparkle: #4a8284; }
        body { font-family: 'Figtree', sans-serif; background: linear-gradient(135deg, var(--light-gray) 0%, #f5f3ed 100%); min-height: 100vh; }
        .form-container { max-width: 600px; margin: 2rem auto; }
        .form-card { background: white; border-radius: 0.75rem; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .form-header { margin-bottom: 2rem; }
        .form-header h2 { color: var(--phthalo-green); font-weight: bold; }
        .btn-submit { background-color: var(--phthalo-green); color: white; }
        .btn-submit:hover { background-color: #0d2605; color: white; }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-card">
            <div class="form-header">
                <h2><i class="bi bi-pencil me-2"></i>Edit Payment</h2>
            </div>

            <form action="{{ route('payments.update', $payment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="student_id" class="form-label">Student *</label>
                    <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->student_id }}" @if(old('student_id', $payment->student_id) == $student->student_id) selected @endif>
                                {{ $student->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="grade_id" class="form-label">Grade *</label>
                    <select class="form-control @error('grade_id') is-invalid @enderror" id="grade_id" name="grade_id" required>
                        <option value="">-- Select Grade --</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->grade_id }}" @if(old('grade_id', $payment->grade_id) == $grade->grade_id) selected @endif>
                                Grade {{ $grade->grade_number }} - {{ $grade->section->class_name ?? 'N/A' }} (${{ number_format($grade->fee_amount, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('grade_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date *</label>
                    <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required>
                    @error('payment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="payment_amount" class="form-label">Payment Amount *</label>
                    <input type="number" step="0.01" class="form-control @error('payment_amount') is-invalid @enderror" id="payment_amount" name="payment_amount" value="{{ old('payment_amount', $payment->payment_amount) }}" required>
                    @error('payment_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-submit btn-lg"><i class="bi bi-check-circle me-2"></i>Update Payment</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary btn-lg"><i class="bi bi-arrow-left me-2"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>