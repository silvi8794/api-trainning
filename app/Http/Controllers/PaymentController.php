<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(\App\Http\Services\PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        return response()->json($this->paymentService->getAll());
    }

    public function store(Request $request)
    {
        $payment = $this->paymentService->create($request->all());
        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return response()->json($payment->load('student'));
    }

    public function update(Request $request, Payment $payment)
    {
        $updated = $this->paymentService->update($payment, $request->all());
        return response()->json($updated);
    }

    public function destroy(Payment $payment)
    {
        $this->paymentService->delete($payment);
        return response()->json(['message' => 'Payment deleted successfully']);
    }

    public function debtors()
    {
        return response()->json($this->paymentService->getDebtors());
    }
}
