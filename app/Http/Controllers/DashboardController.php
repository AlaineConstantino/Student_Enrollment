<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Guardian;
use App\Models\ClassModel;
use App\Models\Enrollment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Show the appropriate dashboard based on user role
     */
    public function index()
    {
        $user = Auth::user();
        Log::info('DashboardController: User role: ' . $user->role);

        if ($user->role === 'admin') {
            \Log::info('DashboardController: Loading admin dashboard');
            // Get statistics for admin dashboard
            $totalStudents = Student::count();
            $totalTeachers = Teacher::count();
            $totalClasses = ClassModel::count();
            $pendingEnrollments = Enrollment::where('status', 'pending')->count();

            return view('dashboards.admin-dashboard', [
                'totalStudents' => $totalStudents,
                'totalTeachers' => $totalTeachers,
                'totalClasses' => $totalClasses,
                'pendingEnrollments' => $pendingEnrollments,
            ]);
        }

        if ($user->role === 'teacher') {
            // Get teacher's classes and students
            $teacher = Teacher::where('email', $user->email)->first();

            // If no teacher record exists, create one
            if (!$teacher) {
                $teacher = Teacher::create([
                    'email' => $user->email,
                    'full_name' => $user->full_name,
                    'contact_number' => 'N/A',
                ]);
            }

            $classes = ClassModel::where('teacher_id', $teacher->teacher_id ?? null)->get();
            $totalStudents = Enrollment::whereIn('class_id', $classes->pluck('class_id'))
                ->where('status', 'enrolled')->count();

            // Get recent enrollments for review
            $pendingEnrollments = Enrollment::whereIn('class_id', $classes->pluck('class_id'))
                ->where('status', 'pending')->with('student')->get();

            // Get class statistics
            $classStats = [];
            foreach ($classes as $class) {
                $enrolled = Enrollment::where('class_id', $class->class_id)->where('status', 'enrolled')->count();
                $capacity = $class->capacity;
                $classStats[] = [
                    'class' => $class,
                    'enrolled' => $enrolled,
                    'available' => $capacity - $enrolled,
                    'utilization' => $capacity > 0 ? round(($enrolled / $capacity) * 100) : 0
                ];
            }

            return view('dashboards.teacher-dashboard', [
                'classes' => $classes,
                'totalStudents' => $totalStudents,
                'teacher' => $teacher,
                'pendingEnrollments' => $pendingEnrollments,
                'classStats' => $classStats,
            ]);
        }

        // User/Parent Dashboard
        // Get students associated with this guardian (by email match)
        $students = Student::whereHas('guardian', function ($query) {
            $query->where('email', Auth::user()->email);
        })->get();

        $pendingEnrollments = Enrollment::whereIn('student_id', $students->pluck('student_id'))
            ->where('status', 'pending')->count();

        $approvedEnrollments = Enrollment::whereIn('student_id', $students->pluck('student_id'))
            ->where('status', 'enrolled')->count();

        $classes = ClassModel::all();

        return view('dashboards.user-dashboard', [
            'students' => $students,
            'pendingEnrollments' => $pendingEnrollments,
            'approvedEnrollments' => $approvedEnrollments,
            'classes' => $classes,
        ]);
    }
}
