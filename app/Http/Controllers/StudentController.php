<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Services\StudentService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API Trainning Documentation",
 *     version="1.0.0",
 *     description="API documentation for the project"
 * )
 * @OA\Server(
 *     url="http://api.training.test/api",
 *     description="API Server"
 * )
 *
 */

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
/**
 * Listado de los registros de estudiantes
 * @OA\Get(
 *     path="/students",
 *     summary="Get a list of students",
 *     tags={"Students"},
 *     @OA\Response(response=200, description="OK"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function index()
    {
        $students = $this->studentService->getAllStudents();
        return response()->json($students);
    }

/**
 * @OA\Post(
 *     path="/students",
 *     summary="Create a new student",
 *     tags={"Students"},
 *     @OA\Response(response=201, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function store(Request $request)
    {
        $student = $this->studentService->createStudent($request->all());
        return response()->json($student, 201);
    }



/**
 * @OA\Get(
 *     path="/students/{id}",
 *     summary="Get a student by ID",
 *     tags={"Students"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=404, description="Student not found")
 * )
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
 * @OA\Put(
 *     path="/students/{id}",
 *     summary="Update a student by ID",
 *     tags={"Students"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
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
 * @OA\Delete(  
 *     path="/students/{id}",
 *     summary="Delete a student by ID",
 *     tags={"Students"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=404, description="Student not found")
 * )
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
