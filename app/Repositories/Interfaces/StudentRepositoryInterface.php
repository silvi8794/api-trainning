<?php

namespace App\Repositories\Interfaces;

use App\Models\Student;
use Illuminate\Support\Collection;

interface StudentRepositoryInterface
{
    /**
     * Get all students.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a student by ID.
     *
     * @param int|string $id
     * @return Student|null
     */
    public function find($id): ?Student;

    /**
     * Create a new student.
     *
     * @param array $data
     * @return Student
     */
    public function create(array $data): Student;

    /**
     * Update an existing student.
     *
     * @param int|string $id
     * @param array $data
     * @return Student|null
     */
    public function update($id, array $data): ?Student;

    /**
     * Delete a student.
     *
     * @param Student $student
     * @return bool
     */
    public function delete(Student $student): bool;

    /**
     * Restore a deleted student.
     *
     * @param Student $student
     * @return bool
     */
    public function restore(Student $student): bool;
}
