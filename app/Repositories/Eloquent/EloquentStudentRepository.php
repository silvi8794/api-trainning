<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentStudentRepository implements StudentRepositoryInterface
{
    protected $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find($id): ?Student
    {
        return $this->model->find($id);
    }

    public function create(array $data): Student
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): ?Student
    {
        $student = $this->find($id);
        if ($student) {
            $student->update($data);
        }
        return $student;
    }

    public function delete(Student $student): bool
    {
        return $student->delete();
    }

    public function restore(Student $student): bool
    {
        return $student->restore();
    }
}
