<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class - Admin</title>
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
                <h2><i class="bi bi-plus-circle me-2"></i>Create New Class</h2>
            </div>

            <form action="{{ route('classes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="class_name" class="form-label">Class Name *</label>
                    <input type="text" class="form-control @error('class_name') is-invalid @enderror" id="class_name" name="class_name" value="{{ old('class_name') }}" placeholder="e.g., Nursery A" required>
                    @error('class_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="age_range" class="form-label">Age Range *</label>
                    <input type="text" class="form-control @error('age_range') is-invalid @enderror" id="age_range" name="age_range" value="{{ old('age_range') }}" placeholder="e.g., 3-4 years" required>
                    @error('age_range')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="capacity" class="form-label">Capacity (Number of Students) *</label>
                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" max="100" required>
                    @error('capacity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="school_year" class="form-label">School Year *</label>
                    <input type="text" class="form-control @error('school_year') is-invalid @enderror" id="school_year" name="school_year" value="{{ old('school_year') }}" placeholder="e.g., 2024-2025" required>
                    @error('school_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="teacher_id" class="form-label">Teacher Assigned</label>
                    <select class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id">
                        <option value="">-- Select Teacher --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->teacher_id }}" @if(old('teacher_id') == $teacher->teacher_id) selected @endif>
                                {{ $teacher->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-submit btn-lg"><i class="bi bi-check-circle me-2"></i>Create Class</button>
                    <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary btn-lg"><i class="bi bi-arrow-left me-2"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
