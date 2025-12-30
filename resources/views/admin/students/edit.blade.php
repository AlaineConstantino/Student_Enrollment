<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($student) ? 'Edit' : 'Create' }} Student - Admin</title>
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
                <h2><i class="bi bi-person-plus me-2"></i>{{ isset($student) ? 'Edit Student' : 'Add New Student' }}</h2>
            </div>

            <form action="{{ isset($student) ? route('students.update', $student->student_id) : route('students.store') }}" method="POST">
                @csrf
                @if(isset($student)) @method('PUT') @endif

                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name *</label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $student->full_name ?? '') }}" required>
                    @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="birth_date" class="form-label">Birth Date *</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', isset($student) ? $student->birth_date?->format('Y-m-d') : '') }}" required>
                    @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender *</label>
                    <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="">-- Select Gender --</option>
                        <option value="Male" @if(old('gender', $student->gender ?? '') === 'Male') selected @endif>Male</option>
                        <option value="Female" @if(old('gender', $student->gender ?? '') === 'Female') selected @endif>Female</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="program" class="form-label">Program *</label>
                    <select class="form-control @error('program') is-invalid @enderror" id="program" name="program" required>
                        <option value="">-- Select Program --</option>
                        <option value="nursery" @if(old('program', $student->program ?? '') === 'nursery') selected @endif>Nursery</option>
                        <option value="kindergarten_1" @if(old('program', $student->program ?? '') === 'kindergarten_1') selected @endif>Kindergarten 1</option>
                        <option value="kindergarten_2" @if(old('program', $student->program ?? '') === 'kindergarten_2') selected @endif>Kindergarten 2</option>
                    </select>
                    @error('program')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $student->address ?? '') }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="guardian_id" class="form-label">Guardian *</label>
                    <select class="form-control @error('guardian_id') is-invalid @enderror" id="guardian_id" name="guardian_id" required>
                        <option value="">-- Select Guardian --</option>
                        @foreach($guardians as $guardian)
                            <option value="{{ $guardian->guardian_id }}" @if(old('guardian_id', $student->guardian_id ?? '') == $guardian->guardian_id) selected @endif>
                                {{ $guardian->full_name }} ({{ $guardian->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('guardian_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $student->notes ?? '') }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-submit btn-lg"><i class="bi bi-check-circle me-2"></i>{{ isset($student) ? 'Update Student' : 'Add Student' }}</button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-lg"><i class="bi bi-arrow-left me-2"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
