<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PromotionsController extends Controller
{
    /**
     * Display a listing of promotions
     */
    public function index(Request $request)
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
        
        return view('admin.promotions.index', compact('promotions', 'status'));
    }

    /**
     * Show the form for creating a new promotion
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created promotion in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'voucher_code' => 'required|string|max:50|unique:promotions,voucher_code',
            'description' => 'nullable|string|max:1000',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'valid_from' => 'required|date|after_or_equal:today',
            'valid_until' => 'required|date|after:valid_from',
            'is_active' => 'boolean',
        ]);

        // Additional validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->withErrors(['discount_value' => 'Percentage discount cannot exceed 100%']);
        }

        $promotion = Promotion::create($request->all());

        return redirect()->route('admin.promotions.index')
                        ->with('success', 'Promotion created successfully.');
    }

    /**
     * Display the specified promotion
     */
    public function show(Promotion $promotion)
    {
        $promotion->load(['payments.order', 'usages.user']);
        
        // Get usage statistics
        $stats = [
            'total_payments' => $promotion->payments_count ?? $promotion->payments()->count(),
            'total_usages' => $promotion->usages_count ?? $promotion->usages()->count(),
            'total_revenue' => $promotion->payments()->where('payment_status', 'paid')->sum('amount'),
            'total_discount_given' => $promotion->calculateTotalDiscountGiven(),
            'usage_percentage' => $promotion->usage_limit ? 
                (($promotion->usages_count ?? 0) / $promotion->usage_limit) * 100 : 0,
        ];
        
        return view('admin.promotions.show', compact('promotion', 'stats'));
    }

    /**
     * Show the form for editing the specified promotion
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified promotion in storage
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'voucher_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('promotions', 'voucher_code')->ignore($promotion->id)
            ],
            'description' => 'nullable|string|max:1000',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'is_active' => 'boolean',
        ]);

        // Additional validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->withErrors(['discount_value' => 'Percentage discount cannot exceed 100%']);
        }

        $promotion->update($request->all());

        return redirect()->route('admin.promotions.index')
                        ->with('success', 'Promotion updated successfully.');
    }

    /**
     * Remove the specified promotion from storage
     */
    public function destroy(Promotion $promotion)
    {
        // Check if promotion has been used
        if ($promotion->payments()->exists() || $promotion->usages()->exists()) {
            return redirect()->back()
                           ->with('error', 'Cannot delete promotion that has been used.');
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')
                        ->with('success', 'Promotion deleted successfully.');
    }

    /**
     * Toggle the active status of a promotion
     */
    public function toggleStatus(Promotion $promotion)
    {
        $promotion->update([
            'is_active' => !$promotion->is_active
        ]);

        $status = $promotion->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
                        ->with('success', "Promotion {$status} successfully.");
    }

    /**
     * Duplicate an existing promotion
     */
    public function duplicate(Promotion $promotion)
    {
        $newPromotion = $promotion->replicate();
        $newPromotion->voucher_code = $promotion->voucher_code . '_COPY_' . time();
        $newPromotion->title = $promotion->title . ' (Copy)';
        $newPromotion->is_active = false;
        $newPromotion->valid_from = now();
        $newPromotion->valid_until = now()->addDays(30);
        $newPromotion->save();

        return redirect()->route('admin.promotions.edit', $newPromotion)
                        ->with('success', 'Promotion duplicated successfully. Please update the details.');
    }

    /**
     * Get promotion usage analytics
     */
    public function analytics(Promotion $promotion)
    {
        $usageByDate = $promotion->usages()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $revenueByDate = $promotion->payments()
            ->where('payment_status', 'paid')
            ->selectRaw('DATE(created_at) as date, SUM(amount) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'usage_by_date' => $usageByDate,
            'revenue_by_date' => $revenueByDate,
        ]);
    }

    /**
     * Export promotions data
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        $status = $request->get('status', 'all');
        
        $query = Promotion::withCount(['payments', 'usages']);

        if ($status === 'active') {
            $query->where('is_active', true)
                  ->where('valid_until', '>', now());
        } elseif ($status === 'expired') {
            $query->where('valid_until', '<=', now());
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $promotions = $query->get();

        if ($format === 'csv') {
            return $this->exportToCsv($promotions);
        }

        return $this->exportToExcel($promotions);
    }

    /**
     * Export promotions to CSV
     */
    private function exportToCsv($promotions)
    {
        $filename = 'promotions_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($promotions) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID', 'Title', 'Voucher Code', 'Discount Type', 'Discount Value',
                'Minimum Amount', 'Usage Limit', 'Times Used', 'Valid From', 'Valid Until',
                'Status', 'Created At'
            ]);

            foreach ($promotions as $promotion) {
                fputcsv($file, [
                    $promotion->id,
                    $promotion->title,
                    $promotion->voucher_code,
                    ucfirst($promotion->discount_type),
                    $promotion->discount_value,
                    $promotion->minimum_amount ?? 'No minimum',
                    $promotion->usage_limit ?? 'Unlimited',
                    $promotion->usages_count ?? 0,
                    $promotion->valid_from,
                    $promotion->valid_until,
                    $promotion->is_active ? 'Active' : 'Inactive',
                    $promotion->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export promotions to Excel (placeholder - requires package like Laravel Excel)
     */
    private function exportToExcel($promotions)
    {
        // This would require a package like maatwebsite/excel
        // For now, fallback to CSV
        return $this->exportToCsv($promotions);
    }
}