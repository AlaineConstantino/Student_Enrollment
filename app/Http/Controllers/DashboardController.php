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

class DashboardController extends Controller
{
    /**
     * Show the appropriate dashboard based on user role
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
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

        // User/Parent Dashboard
        // Get students associated with this guardian (by email match)
        $students = Student::whereHas('guardian', function ($query) {
            $query->where('email', Auth::user()->email);
        })->get();
        
        $pendingEnrollments = Enrollment::whereIn('student_id', $students->pluck('student_id'))
            ->where('status', 'pending')->count();
        
        $approvedEnrollments = Enrollment::whereIn('student_id', $students->pluck('student_id'))
            ->where('status', 'approved')->count();
        
        $classes = ClassModel::all();

        return view('dashboards.user-dashboard', [
            'students' => $students,
            'pendingEnrollments' => $pendingEnrollments,
            'approvedEnrollments' => $approvedEnrollments,
            'classes' => $classes,
        ]);
    }
}
