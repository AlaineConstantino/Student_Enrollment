<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Grade - Admin</title>
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
                <h2><i class="bi bi-pencil me-2"></i>Edit Grade</h2>
            </div>

            <form action="{{ route('grades.update', $grade) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="grade_number" class="form-label">Grade Number *</label>
                    <input type="number" class="form-control @error('grade_number') is-invalid @enderror" id="grade_number" name="grade_number" value="{{ old('grade_number', $grade->grade_number) }}" required>
                    @error('grade_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="section_id" class="form-label">Section *</label>
                    <select class="form-control @error('section_id') is-invalid @enderror" id="section_id" name="section_id" required>
                        <option value="">-- Select Section --</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->class_id }}" @if(old('section_id', $grade->section_id) == $section->class_id) selected @endif>
                                {{ $section->class_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="subject_id" class="form-label">Subject ID</label>
                    <input type="number" class="form-control @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" value="{{ old('subject_id', $grade->subject_id) }}">
                    @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="fee_amount" class="form-label">Fee Amount *</label>
                    <input type="number" step="0.01" class="form-control @error('fee_amount') is-invalid @enderror" id="fee_amount" name="fee_amount" value="{{ old('fee_amount', $grade->fee_amount) }}" required>
                    @error('fee_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-submit btn-lg"><i class="bi bi-check-circle me-2"></i>Update Grade</button>
                    <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary btn-lg"><i class="bi bi-arrow-left me-2"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>