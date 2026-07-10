<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->latest()->get();
        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        
        return view('enrollments.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'    => [
                'required',
                'exists:students,id',
                Rule::unique('enrollments')->where(function ($query) use ($request) {
                    return $query->where('course_id', $request->course_id);
                })
            ],
            'course_id'     => 'required|exists:courses,id',
            'enroll_date'   => 'required|date',
            'final_fee'     => 'required|numeric|min:0',
        ], [
            'student_id.unique' => 'This student is already enrolled in this course.' 
        ]);

        $course = Course::findOrFail($validated['course_id']);

        $validated['course_name']   = $course->name;
        $validated['original_fee']  = $course->fee;

        Enrollment::create($validated);

        return redirect()
                ->route('enrollments.index')
                ->with('success', 'Enrollment recorded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();

        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('enrollments')
                    ->where(fn ($query) =>
                        $query->where('course_id', $request->course_id)
                    )
                    ->ignore($enrollment->id),
            ],
            'course_id'     => 'required|exists:courses,id',
            'enroll_date'   => 'required|date',
            'final_fee'     => 'required|numeric|min:0',
            'status'        => 'required|in:active,completed,cancelled'
        ], [
            'student_id.unique' => 'This student is already enrolled in this course.' 
        ]);

        $course = Course::findOrFail($validated['course_id']);

        $validated['course_name']   = $course->name;
        $validated['original_fee']  = $course->fee;

        $enrollment->update($validated);

        return redirect()
                ->route('enrollments.index')
                ->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        
        return redirect()
                ->route('enrollments.index')
                ->with('success', 'Enrollment deleted successfully.');
    }
}
