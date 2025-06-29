<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Promotion;
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
        $status = $request->get('status', 'all');
        
        $query = Payment::with(['order.product', 'order.shippingInfo', 'user', 'promotion'])
                        ->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('payment_status', $status);
        }

        $payments = $query->paginate(15);
        
        return view('admin.payments.index', compact('payments', 'status'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['order.product', 'order.shippingInfo', 'user', 'promotion']);
        
        return view('admin.payments.show', compact('payment'));
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $payment->update([
            'payment_status' => $request->payment_status
        ]);

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    public function promotions(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Promotion::withCount(['payments', 'usages'])
                          ->orderBy('created_at', 'desc');

        if ($status === 'active') {
            $query->where('is_active', true)
                  ->where('valid_until', '>', now());
        } elseif ($status === 'expired') {
            $query->where('valid_until', '<=', now());
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $promotions = $query->paginate(15);
        
        return view('admin.payments.promotions', compact('promotions', 'status'));
    }

    public function createPromotion()
    {
        return view('admin.payments.create-promotion');
    }

    public function storePromotion(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'voucher_code' => 'required|string|unique:promotions,voucher_code',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'is_active' => 'boolean',
        ]);

        Promotion::create($request->all());

        return redirect()->route('admin.payments.promotions')
                        ->with('success', 'Promotion created successfully.');
    }

    public function togglePromotionStatus(Promotion $promotion)
    {
        $promotion->update([
            'is_active' => !$promotion->is_active
        ]);

        $status = $promotion->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()->with('success', "Promotion {$status} successfully.");
    }
}