<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $showArchived = $request->input('archived');

        $query = ClassModel::query();

        if ($search) {
            $query->where('class_name', 'like', "%{$search}%");
        }

        if ($showArchived) {
            $query->onlyTrashed();
        } else {
            $query->whereNull('deleted_at');
        }

        $classes = $query->paginate(15);

        $archived = ClassModel::onlyTrashed()->paginate(15);

        return view('admin.class-management', [
            'classes' => $classes,
            'archived' => $archived,
        ]);
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('admin.classes.create', ['teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'age_range' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:100',
            'school_year' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,teacher_id',
        ]);

        ClassModel::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function edit(ClassModel $classModel)
    {
        $teachers = Teacher::all();
        return view('admin.classes.edit', ['class' => $classModel, 'teachers' => $teachers]);
    }

    public function update(Request $request, ClassModel $classModel)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'age_range' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:100',
            'school_year' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,teacher_id',
        ]);

        $classModel->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassModel $classModel)
    {
        $classModel->delete();
        return redirect()->route('classes.index')->with('success', 'Class archived successfully.');
    }

    public function restore($id)
    {
        ClassModel::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('classes.index')->with('success', 'Class restored successfully.');
    }
}
