<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $search = $request->input('search');
            $showArchived = $request->input('archived');

            $query = Student::with('guardian');

            if ($search) {
                $query->where('full_name', 'like', "%{$search}%");
            }

            if ($showArchived) {
                $query->onlyTrashed();
            } else {
                $query->whereNull('deleted_at');
            }

            $students = $query->paginate(15);

            $archived = Student::with('guardian')->onlyTrashed()->paginate(15);

            return view('admin.student-management', [
                'students' => $students,
                'archived' => $archived,
            ]);
        } elseif ($user->role === 'parent') {
            // For parents, show only their children
            $students = Student::whereHas('guardian', function ($query) use ($user) {
                $query->where('email', $user->email);
            })->get();

            return view('dashboards.user-dashboard', [
                'students' => $students,
                'pendingEnrollments' => 0, // Not needed for this view
                'approvedEnrollments' => 0,
                'classes' => [],
            ]);
        } else {
            abort(403, 'Unauthorized access');
        }
    }

    public function create()
    {
        $guardians = Guardian::all();
        return view('admin.students.edit', ['guardians' => $guardians]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:255',
            'program' => 'required|in:nursery,kindergarten_1,kindergarten_2',
            'guardian_id' => 'required|exists:guardians,guardian_id',
            'notes' => 'nullable|string|max:500',
        ]);

        Student::create($validated);
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        $guardians = Guardian::all();
        return view('admin.students.edit', ['student' => $student, 'guardians' => $guardians]);
    }

    public function editParent(Student $student)
    {
        // Verify parent authorization
        $guardian = $student->guardian;
        if ($guardian && $guardian->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access');
        }
        
        return view('students.edit-parent', ['student' => $student]);
    }

    public function updateParent(Request $request, Student $student)
    {
        // Verify parent authorization
        $guardian = $student->guardian;
        if (!$guardian || $guardian->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255',
            'program' => 'required|in:nursery,kindergarten_1,kindergarten_2',
            'notes' => 'nullable|string|max:500',
        ]);

        $student->update($validated);
        
        return redirect()->route('dashboard')->with('success', 'Child details updated successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:255',
            'program' => 'required|in:nursery,kindergarten_1,kindergarten_2',
            'guardian_id' => 'required|exists:guardians,guardian_id',
            'notes' => 'nullable|string|max:500',
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroyParent(Student $student)
    {
        // Verify parent authorization
        $guardian = $student->guardian;
        if (!$guardian || $guardian->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access');
        }

        // Check if child has any enrolled enrollments
        $hasApprovedEnrollment = Enrollment::where('student_id', $student->student_id)
            ->where('status', 'enrolled')
            ->exists();

        if ($hasApprovedEnrollment) {
            return redirect()->route('dashboard')->with('error', 'Cannot remove a child with an approved enrollment. Please contact the administrator.');
        }

        $student->delete();
        return redirect()->route('dashboard')->with('success', 'Child has been removed from the system.');
    }

    public function restoreParent($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        
        // Verify parent authorization
        $guardian = $student->guardian;
        if (!$guardian || $guardian->email !== auth()->user()->email) {
            abort(403, 'Unauthorized access');
        }

        $student->restore();
        return redirect()->route('dashboard')->with('success', 'Child has been restored.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student archived successfully.');
    }

    public function restore(Student $student)
    {
        $student->restore();
        return redirect()->route('students.index')->with('success', 'Student restored successfully.');
    }
}
