<?php

namespace App\Repositories\Interfaces;

use App\Models\Attendance;
use Illuminate\Support\Collection;

interface AttendanceRepositoryInterface
{
    /**
     * Create a new attendance record.
     *
     * @param array $data
     * @return Attendance
     */
    public function create(array $data): Attendance;

    /**
     * Get the latest attendance records.
     *
     * @param int $limit
     * @return Collection
     */
    public function getLatest(int $limit = 50): Collection;

    /**
     * Get attendance records for a specific student.
     *
     * @param int|string $studentId
     * @return Collection
     */
    public function getByStudent($studentId): Collection;
}
