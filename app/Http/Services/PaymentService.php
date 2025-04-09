<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    public function update(Payment $payment, array $data): Payment
    {
        $payment->update($data);
        return $payment;
    }

    public function delete(Payment $payment): void
    {
        $payment->delete();
    }

    public function getAll()
    {
        return Payment::with('student')->latest()->get();
    }

    public function getByStudent($studentId)
    {
        return Payment::where('student_id', $studentId)->get();
    }
}
