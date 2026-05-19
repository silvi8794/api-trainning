<?php

namespace App\Repositories\Eloquent;

use App\Models\Attendance;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentAttendanceRepository implements AttendanceRepositoryInterface
{
    protected $model;

    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Attendance
    {
        return $this->model->create($data);
    }

    public function getLatest(int $limit = 50): Collection
    {
        return $this->model->with('student')->latest()->limit($limit)->get();
    }

    public function getByStudent($studentId): Collection
    {
        return $this->model->where('student_id', $studentId)->latest()->get();
    }
}
