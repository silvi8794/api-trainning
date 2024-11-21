<?php

namespace App\Http\Services;

use App\Models\Student;


class StudentService
{
    public function getAllStudents()
    {
        return Student::all();
    }

    public function getStudentById($id)
    {
        return Student::find($id);
    }

    public function createStudent(array $data)
    {
        try{
            $student = Student::create($data);

            $student->created_at = $student->created_at->format('Y-m-d H:i:s');
            $student->updated_at = $student->updated_at->format('Y-m-d H:i:s');
            
            return $student;
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        
    }

    public function updateStudent(Student $student, array $data)
    {
        $student->update($data);
        return $student;
    }

    public function deleteStudent(Student $student)
    {
        $student->delete();
    }   

    public function restoreStudent(Student $student)
    {
        $student->restore();
    }

}
