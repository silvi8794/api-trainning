<?php

namespace App\Http\Services;

use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\Log;

class StudentService
{
    public function getAllStudents()
    {
        try {
            return Student::all();
        } catch (Exception $e) {
            Log::error('Error al obtener estudiantes: ' . $e->getMessage());
            return collect();
        }
    }

    public function getStudentById($id)
    {
        try {
            return Student::find($id);
        } catch (Exception $e) {
            Log::error('Error al obtener estudiante por ID: ' . $e->getMessage(), ['id' => $id]);
            return null;
        }
    }

    public function createStudent(array $data)
    {
        try {
            $student = Student::create($data);

            $student->created_at = $student->created_at->format('Y-m-d H:i:s');
            $student->updated_at = $student->updated_at->format('Y-m-d H:i:s');

            return $student;
        } catch (\Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage(), ['data' => $data]);
            return null;
        }
    }

    public function updateStudent(Student $student, array $data)
    {
        try {
            $student->update($data);
            return $student;
        } catch (Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage(), ['student_id' => $student->id]);
            return null;
        }
    }

    public function deleteStudent(Student $student)
    {
        try {
            $student->delete();
            return true;
        } catch (Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage(), ['student_id' => $student->id]);
            return false;
        }
    }

    public function restoreStudent(Student $student)
    {
        try {
            $student->restore();
            return true;
        } catch (Exception $e) {
            Log::error('Error restoring student: ' . $e->getMessage(), ['student_id' => $student->id]);
            return false;
        }
    }
}
