<?php

namespace App\Http\Services;

use App\Models\Payment;
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

    public function getDebtors()
    {
        try {
            return \App\Models\Student::whereDoesntHave('payments', function ($query) {
                $query->whereMonth('payment_date', now()->month)
                      ->whereYear('payment_date', now()->year)
                      ->where('is_paid', true);
            })->get();
        } catch (Exception $e) {
            Log::error('Error getting debtors: ' . $e->getMessage());
            return collect();
        }
    }
}
