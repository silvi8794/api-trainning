<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(\App\Http\Services\AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        return response()->json($this->attendanceService->getLatestAttendances());
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'notes' => 'nullable|string',
        ]);

        $attendance = $this->attendanceService->checkIn($request->student_id, $request->notes);
        return response()->json($attendance, 201);
    }

    public function show($studentId)
    {
        return response()->json($this->attendanceService->getStudentAttendances($studentId));
    }
}
