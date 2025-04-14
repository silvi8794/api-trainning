<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class PaymentService
{
    public function create(array $data): ?Payment
    {
        try {
            return Payment::create($data);
        } catch (Exception $e) {
            Log::error('Error creating payment: ' . $e->getMessage(), ['data' => $data]);
            return null;
        }
    }

    public function update(Payment $payment, array $data): ?Payment
    {
        try {
            $payment->update($data);
            return $payment;
        } catch (Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage(), ['payment_id' => $payment->id]);
            return null;
        }
    }

    public function delete(Payment $payment): bool
    {
        try {
            return $payment->delete();
        } catch (Exception $e) {
            Log::error('Error deleting payment: ' . $e->getMessage(), ['payment_id' => $payment->id]);
            return false;
        }
    }

    public function getAll()
    {
        try {
            return Payment::with('student')->latest()->get();
        } catch (Exception $e) {
            Log::error('Error getting all payments: ' . $e->getMessage());
            return collect();
        }
    }

    public function getByStudent($studentId)
    {
        try {
            return Payment::where('student_id', $studentId)->get();
        } catch (Exception $e) {
            Log::error('Error getting payments from student: ' . $e->getMessage(), ['student_id' => $studentId]);
            return collect();
        }
    }
}
