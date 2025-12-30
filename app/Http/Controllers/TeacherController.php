<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $showArchived = $request->input('archived');

        $query = Teacher::query();

        if ($search) {
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        if ($showArchived) {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at');
        }

        $teachers = $query->paginate(15);

        $archived = Teacher::onlyTrashed()->paginate(15);

        return view('admin.teacher-management', [
            'teachers' => $teachers,
            'archived' => $archived,
        ]);
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'contact_number' => 'required|string|max:20',
        ]);

        Teacher::create($request->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', ['teacher' => $teacher]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->teacher_id . ',teacher_id',
            'contact_number' => 'required|string|max:20',
        ]);

        $teacher->update($request->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher archived successfully.');
    }

    public function restore($id)
    {
        Teacher::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('teachers.index')->with('success', 'Teacher restored successfully.');
    }
}
