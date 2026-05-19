<?php

namespace App\Http\Services;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Get all students.
     *
     * @return Collection
     */
    public function getAllStudents(): Collection
    {
        try {
            return $this->studentRepository->all();
        } catch (Exception $e) {
            Log::error('Error getting all students: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Get a student by ID.
     *
     * @param int|string $id
     * @return Student|null
     */
    public function getStudentById($id): ?Student
    {
        try {
            return $this->studentRepository->find($id);
        } catch (Exception $e) {
            Log::error('Error getting student by ID: ' . $e->getMessage(), ['id' => $id]);
            return null;
        }
    }

    /**
     * Create a new student.
     *
     * @param array $data
     * @return Student|null
     */
    public function createStudent(array $data): ?Student
    {
        try {
            return $this->studentRepository->create($data);
        } catch (Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage(), ['data' => $data]);
            return null;
        }
    }

    /**
     * Update an existing student.
     *
     * @param int|string $id
     * @param array $data
     * @return Student|null
     */
    public function updateStudent($id, array $data): ?Student
    {
        try {
            return $this->studentRepository->update($id, $data);
        } catch (Exception $e) {
            Log::error("Error updating student ID {$id}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete a student.
     *
     * @param Student $student
     * @return bool
     */
    public function deleteStudent(Student $student): bool
    {
        try {
            return $this->studentRepository->delete($student);
        } catch (Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage(), ['student_id' => $student->id]);
            return false;
        }
    }

    /**
     * Restore a deleted student.
     *
     * @param Student $student
     * @return bool
     */
    public function restoreStudent(Student $student): bool
    {
        try {
            return $this->studentRepository->restore($student);
        } catch (Exception $e) {
            Log::error('Error restoring student: ' . $e->getMessage(), ['student_id' => $student->id]);
            return false;
        }
    }
}
