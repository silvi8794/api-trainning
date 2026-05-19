<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AttendanceService
{
    protected $attendanceRepository;
    protected $studentRepository;

    public function __construct(
        AttendanceRepositoryInterface $attendanceRepository,
        StudentRepositoryInterface $studentRepository
    ) {
        $this->attendanceRepository = $attendanceRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * Register a student attendance.
     *
     * @param int|string $studentId
     * @param string|null $notes
     * @return \App\Models\Attendance
     * @throws Exception
     */
    public function checkIn($studentId, $notes = null)
    {
        try {
            $student = $this->studentRepository->find($studentId);

            if (!$student) {
                throw new Exception("Student with ID {$studentId} not found.");
            }
            
            // Business logic: check if student is active, etc.
            if ($student->state !== 'active') {
                throw new Exception("Student is not active.");
            }
            
            return $this->attendanceRepository->create([
                'student_id' => $studentId,
                'check_in_at' => Carbon::now(),
                'notes' => $notes,
            ]);
        } catch (Exception $e) {
            Log::error('Error during attendance check-in: ' . $e->getMessage(), ['student_id' => $studentId]);
            throw $e;
        }
    }

    /**
     * Get the latest attendance records.
     *
     * @param int $limit
     * @return Collection
     */
    public function getLatestAttendances($limit = 50): Collection
    {
        return $this->attendanceRepository->getLatest($limit);
    }

    /**
     * Get all attendance records for a specific student.
     *
     * @param int|string $studentId
     * @return Collection
     */
    public function getStudentAttendances($studentId): Collection
    {
        return $this->attendanceRepository->getByStudent($studentId);
    }
}
