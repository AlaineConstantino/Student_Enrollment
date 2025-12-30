<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('section')->paginate(15);
        return view('admin.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = ClassModel::all();
        return view('admin.grades.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade_number' => 'required|integer',
            'section_id' => 'required|exists:classes,class_id',
            'subject_id' => 'nullable|integer',
            'fee_amount' => 'required|numeric|min:0',
        ]);

        Grade::create($validated);
        return redirect()->route('grades.index')->with('success', 'Grade created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return view('admin.grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $sections = ClassModel::all();
        return view('admin.grades.edit', compact('grade', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'grade_number' => 'required|integer',
            'section_id' => 'required|exists:classes,class_id',
            'subject_id' => 'nullable|integer',
            'fee_amount' => 'required|numeric|min:0',
        ]);

        $grade->update($validated);
        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}
