<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = \App\Models\Payment::with(['user', 'order']);

        // Filter using payment_status instead of order.status
        if ($status !== 'all') {
            $query->where('payment_status', $status);
        }

        $payments = $query->latest()->paginate(15);

        return view('admin.payments.index', compact('payments', 'status'));
    }

   public function updateStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $payment->payment_status = $request->payment_status;
        $payment->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.payments')->with('status', 'Payment status updated.');
    }

}
