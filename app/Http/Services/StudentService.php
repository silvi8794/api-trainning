<?php

namespace App\Http\Services;

use App\Models\Student;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class StudentService
{
    protected $studentModel;

    public function __construct(Student $studentModel)
    {
        $this->studentModel = $studentModel;
    }

    public function getAllStudents(): Collection
    {
        try {
            return $this->studentModel->all();
        } catch (Exception $e) {
            Log::error('Error getting students: ' . $e->getMessage());
            return collect();
        }
    }

    public function getStudentById($id): ?Student
    {
        try {
            return $this->studentModel->find($id);
        } catch (Exception $e) {
            Log::error('Error al obtener estudiante por ID: ' . $e->getMessage(), ['id' => $id]);
            return null;
        }
    }

    public function createStudent(array $data): ?Student
    {
        try {
            $student = $this->studentModel->create($data);

            return $student;
        } catch (\Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage(), ['data' => $data]);
            return null;
        }
    }

    public function updateStudent($id, array $data): ?Student
    {
        try {
            $student = $this->studentModel->find($id);
            if (!$student) {
                return null;
            }
            $student->update($data);
            return $student;
        } catch (Exception $e) {
            Log::error("Error updating student ID {$id}: " . $e->getMessage());
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
