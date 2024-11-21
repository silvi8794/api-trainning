<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $students = $this->studentService->getAllStudents();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $student = $this->studentService->createStudent($request->all());
        return response()->json($student, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        try{
            $student = $this->studentService->getStudentById($student->id);
            return response()->json($student);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        try{
            $student = $this->studentService->updateStudent($student, $request->all());
            return response()->json($student);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try{
            $this->studentService->deleteStudent($student);
            return response()->json(['message' => 'Student deleted successfully'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
