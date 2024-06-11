<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\TaskType;
use App\Models\StudentTeacherHomeroomRelationship;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $taskTypes = TaskType::all();
        $studentTeacherHomeroomRelationships = StudentTeacherHomeroomRelationship::all();

        $gradesQuery = Grade::with(['taskType', 'studentTeacherHomeroomRelationship.teacherHomeroomRelationship.teacher']);

        if ($request->filled('task_type_id')) {
            $gradesQuery->where('task_type_id', $request->task_type_id);
        }

        if ($request->filled('student_teacher_homeroom_relationship_id')) {
            $gradesQuery->where('student_teacher_homeroom_relationship_id', $request->student_teacher_homeroom_relationship_id);
        }

        $grades = $gradesQuery->get();

        $data = [
            'title' => 'Grades',
            'grades' => $grades,
            'taskTypes' => $taskTypes,
            'studentTeacherHomeroomRelationships' => $studentTeacherHomeroomRelationships,
        ];

        return view('teacher.grade.index', $data);
    }


    public function create()
    {
        $taskTypes = TaskType::all();
        $studentTeacherHomeroomRelationships = StudentTeacherHomeroomRelationship::all();
        $title = 'Add Grades';

        return view('teacher.grade.form', compact('taskTypes', 'studentTeacherHomeroomRelationships', 'title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_type_id' => 'required|exists:task_types,id',
            'student_teacher_homeroom_relationship_id' => 'required|exists:student_teacher_homeroom_relationships,id',
            'value' => 'required|numeric|min:0|max:100'
        ]);

        Grade::create($validatedData);

        return redirect()->route('grade.index')->with('success', 'Grade successfully added');
    }

    public function edit(Grade $grade)
    {
        $taskTypes = TaskType::all();
        $studentTeacherHomeroomRelationships = StudentTeacherHomeroomRelationship::all();
        $title = 'Edit Grade';

        return view('teacher.grade.form', compact('grade', 'taskTypes', 'studentTeacherHomeroomRelationships', 'title'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validatedData = $request->validate([
            'task_type_id' => 'required|exists:task_types,id',
            'student_teacher_homeroom_relationship_id' => 'required|exists:student_teacher_homeroom_relationships,id',
            'value' => 'required|numeric|min:0|max:100'
        ]);

        $grade->update($validatedData);

        return redirect()->route('grade.index')->with('success', 'Grade successfully updated');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grade.index')->with('success', 'Grade successfully deleted');
    }
}
