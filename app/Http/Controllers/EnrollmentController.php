<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $showArchived = $request->input('archived');

        $query = Enrollment::with(['student', 'student.guardian', 'classModel']);

        if ($search) {
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%");
            })->orWhereHas('student.guardian', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%");
            });
        }

        if ($showArchived) {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at');
        }

        $enrollments = $query->paginate(15);

        $archived = Enrollment::with(['student', 'student.guardian', 'classModel'])->onlyTrashed()->paginate(15);

        return view('admin.enrollment-management', [
            'enrollments' => $enrollments,
            'archived' => $archived,
        ]);
    }

    public function create()
    {
        return view('admin.enrollments.create');
    }

    public function createForParent()
    {
        return view('enrollments.create');
    }

    public function store(Request $request)
    {
        // If create_student flag is set, create a new student and guardian first
        if ($request->input('create_student') === 'true') {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'gender' => 'required|in:male,female',
                'address' => 'required|string|max:255',
                'notes' => 'nullable|string|max:500',
                'guardian_full_name' => 'required|string|max:255',
                'guardian_email' => 'required|email|max:255',
                'guardian_phone_number' => 'required|string|max:20',
                'relationship' => 'required|string|max:255',
                'program' => 'required|in:nursery,kindergarten_1,kindergarten_2',
            ]);

            // Create or update guardian with the provided information
            $guardian = \App\Models\Guardian::updateOrCreate(
                ['email' => $validated['guardian_email']],
                [
                    'full_name' => $validated['guardian_full_name'],
                    'email' => $validated['guardian_email'],
                    'phone_number' => $validated['guardian_phone_number'],
                    'relationship' => $validated['relationship'],
                    'address' => $validated['address'],
                ]
            );

            // Create the student and link to guardian
            $student = Student::create([
                'full_name' => $validated['full_name'],
                'birth_date' => $validated['birth_date'],
                'gender' => $validated['gender'],
                'address' => $validated['address'],
                'program' => $validated['program'],
                'notes' => $validated['notes'] ?? null,
                'guardian_id' => $guardian->guardian_id,
            ]);

            // Create a pending enrollment for the selected program
            Enrollment::create([
                'student_id' => $student->student_id,
                'class_id' => null,
                'status' => 'pending',
            ]);
        } else {
            // Standard enrollment creation
            Enrollment::create($request->all());
        }

        return redirect()->route('dashboard')->with('success', 'Child registered successfully and pending enrollment created!');
    }

    public function edit(Enrollment $enrollment)
    {
        $classes = ClassModel::all();
        return view('admin.enrollments.edit', [
            'enrollment' => $enrollment,
            'classes' => $classes
        ]);
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $status = $request->input('status');

        if ($status === 'enrolled') {
            // Approval requires class selection
            $validated = $request->validate([
                'status' => 'required|in:enrolled',
                'class_id' => 'required|exists:classes,class_id',
                'enrollment_date' => 'nullable|date',
            ]);

            $enrollment->update([
                'status' => 'enrolled',
                'class_id' => $validated['class_id'],
                'enrollment_date' => $validated['enrollment_date'] ?? now(),
                'decline_reason' => null, // Clear any previous decline reason
            ]);

            return redirect()->route('enrollments.index')->with('success', 'Enrollment approved successfully and student assigned to class.');
        } else if ($status === 'withdrawn') {
            // Decline requires reason
            $validated = $request->validate([
                'status' => 'required|in:withdrawn',
                'decline_reason' => 'required|string|min:10|max:500',
            ]);

            $enrollment->update($validated);

            return redirect()->route('enrollments.index')->with('success', 'Enrollment declined. Reason has been sent to parent.');
        } else {
            return redirect()->route('enrollments.index')->with('error', 'Invalid action.');
        }
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment archived successfully.');
    }

    public function restore($id)
    {
        Enrollment::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment restored successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['status' => $request->status]);
        return $enrollment;
    }
}
