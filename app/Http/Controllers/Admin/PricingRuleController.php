<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PricingRuleRequest;
use App\Models\PricingRule;
use Illuminate\Http\Request;

class PricingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_pricing_rules, show_pricing_rules')) {
    //         return redirect('admin/index');
    //     }

    //     $pricingRules = PricingRule::query()
    //         ->when(request('type'), fn($q) => $q->where('type', request('type')))
    //         ->when(request('zone'), fn($q) => $q->where('zone', 'like', '%' . request('zone') . '%'))
    //         ->orderBy(request('sort_by') ?? 'created_at', request('order_by') ?? 'desc')
    //         ->paginate(request('limit_by') ?? 50);

    //     return view('admin.pricing_rules.index', compact('pricingRules'));
    // }

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_pricing_rules, show_pricing_rules')) {
            return redirect('admin/index');
        }

        $query = PricingRule::query();

        // البحث باستخدام SearchableTrait
        if ($search = request('keyword')) {
            $query = PricingRule::search($search);
        }

        // فلاتر إضافية
        if ($type = request('type')) {
            $query->where('type', $type);
        }

        if ($zone = request('zone')) {
            $query->where('zone', 'like', "%{$zone}%");
        }

        if (request()->has('status') && request('status') !== '') {
            $query->where('status', request('status'));
        }

        // ترتيب النتائج
        $sortBy = request('sort_by') ?? 'created_at';
        $orderBy = request('order_by') ?? 'desc';
        $query->orderBy($sortBy, $orderBy);

        // التصفح Pagination
        $pricingRules = $query->paginate(request('limit_by') ?? 50)->withQueryString();

        return view('admin.pricing_rules.index', compact('pricingRules'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_pricing_rules')) {
            return redirect('admin/index');
        }

        return view('admin.pricing_rules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PricingRuleRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_pricing_rules')) {
            return redirect('admin/index');
        }

        $input = $request->only([
            'type', 'zone', 'min_weight', 'max_weight', 'max_length', 'max_width', 'max_height',
            'base_price', 'price_per_kg', 'extra_fee', 'oversized', 'fragile', 'perishable',
            'express', 'same_day', 'status'
        ]);

        // الحقول المترجمة
        $input['name'] = $request->name;
        $input['description'] = $request->description;

        $pricingRule = PricingRule::create($input);

        if ($pricingRule) {
            return redirect()->route('admin.pricing_rules.index')->with([
                'message' => __('messages.pricing_rule_created'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.pricing_rules.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PricingRule $pricingRule)
    {
        return view('admin.pricing_rules.show', compact('pricingRule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PricingRule $pricingRule)
    {
        if (!auth()->user()->ability('admin', 'update_pricing_rules')) {
            return redirect('admin/index');
        }

        return view('admin.pricing_rules.edit', compact('pricingRule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PricingRuleRequest $request, PricingRule $pricingRule)
    {
        if (!auth()->user()->ability('admin', 'update_pricing_rules')) {
            return redirect('admin/index');
        }

        $input = $request->only([
            'type', 'zone', 'min_weight', 'max_weight', 'max_length', 'max_width', 'max_height',
            'base_price', 'price_per_kg', 'extra_fee', 'oversized', 'fragile', 'perishable',
            'express', 'same_day', 'status'
        ]);

        // الحقول المترجمة
        $input['name'] = $request->name;
        $input['description'] = $request->description;

        $pricingRule->update($input);

        return redirect()->route('admin.pricing_rules.index')->with([
            'message' => __('messages.pricing_rule_updated'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PricingRule $pricingRule)
    {
        if (!auth()->user()->ability('admin', 'delete_pricing_rules')) {
            return redirect('admin/index');
        }

        $pricingRule->delete();

        return redirect()->route('admin.pricing_rules.index')->with([
            'message' => __('messages.pricing_rule_deleted'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Update status via AJAX.
     */
    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $pricingRule = PricingRule::findOrFail($request->id);
            $pricingRule->status = !$pricingRule->status;
            $pricingRule->save();

            return response()->json([
                'status' => $pricingRule->status,
                'pricing_rule_id' => $pricingRule->id
            ]);
        }
    }
}
