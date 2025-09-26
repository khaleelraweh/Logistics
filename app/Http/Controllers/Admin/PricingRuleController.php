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

    // بحث باستخدام SearchableTrait
    if ($search = request('keyword')) {
        $query->search($search);
    }

    // فلترة type
    if ($type = request('type')) {
        $query->where('type', $type);
    }

    // فلترة zone
    if ($zone = request('zone')) {
        $query->where('zone', 'like', "%{$zone}%");
    }

    // فلترة status
    if (request()->has('status') && request('status') !== '') {
        $query->where('status', request('status') == '1');
    }

    // ترتيب النتائج
    $sortBy = request('sort_by') ?? 'created_at';
    $orderBy = request('order_by') ?? 'desc';
    $query->orderByRaw(
        $sortBy == 'published_on'
            ? 'published_on IS NULL, published_on ' . $orderBy
            : $sortBy . ' ' . $orderBy
    );

    // Pagination
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
    // public function store(PricingRuleRequest $request)
    // {
    //     if (!auth()->user()->ability('admin', 'create_pricing_rules')) {
    //         return redirect('admin/index');
    //     }

    //     // الحقول المترجمة
    //     $input['name'] = $request->name;
    //     $input['description'] = $request->description;
    //     $input['type'] = $request->type;
    //     $input['zone'] = $request->zone;
    //     $input['min_weight'] = $request->min_weight;
    //     $input['max_weight'] = $request->max_weight;
    //     $input['max_length'] = $request->max_length;
    //     $input['max_width'] = $request->max_width;
    //     $input['max_height'] = $request->max_height;
    //     $input['base_price'] = $request->base_price;
    //     $input['price_per_kg'] = $request->price_per_kg;
    //     $input['extra_fee'] = $request->extra_fee;
    //     $input['oversized'] = $request->oversized;
    //     $input['fragile'] = $request->fragile;
    //     $input['perishable'] = $request->perishable;
    //     $input['express'] = $request->express;
    //     $input['same_day'] = $request->same_day;
    //     $input['status'] = $request->status;

    //     $pricingRule = PricingRule::create($input);

    //     if ($pricingRule) {
    //         return redirect()->route('admin.pricing_rules.index')->with([
    //             'message' => __('messages.pricing_rule_created'),
    //             'alert-type' => 'success'
    //         ]);
    //     }

    //     return redirect()->route('admin.pricing_rules.index')->with([
    //         'message' => __('messages.something_went_wrong'),
    //         'alert-type' => 'danger'
    //     ]);
    // }

    public function store(PricingRuleRequest $request)
{
    if (!auth()->user()->ability('admin', 'create_pricing_rules')) {
        return redirect('admin/index');
    }

    $input['name']        = $request->name;
    $input['description'] = $request->description;
    $input['type']        = $request->type;
    $input['zone']        = $request->zone;
    $input['min_weight']  = $request->min_weight;
    $input['max_weight']  = $request->max_weight;
    $input['max_length']  = $request->max_length;
    $input['max_width']   = $request->max_width;
    $input['max_height']  = $request->max_height;
    $input['base_price']  = $request->base_price;
    $input['price_per_kg']= $request->price_per_kg;
    $input['extra_fee']   = $request->extra_fee;

    // Handle checkboxes
    $input['oversized']   = $request->has('oversized') ? 1 : 0;
    $input['fragile']     = $request->has('fragile') ? 1 : 0;
    $input['perishable']  = $request->has('perishable') ? 1 : 0;
    $input['express']     = $request->has('express') ? 1 : 0;
    $input['same_day']    = $request->has('same_day') ? 1 : 0;
    $input['status']      = $request->has('status') ? 1 : 0;

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
    public function show($id)
    {
        $pricingRule = PricingRule::findOrFail($id);
        return view('admin.pricing_rules.show', compact('pricingRule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_pricing_rules')) {
            return redirect('admin/index');
        }

        $pricingRule = PricingRule::findOrFail($id);
        return view('admin.pricing_rules.edit', compact('pricingRule'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PricingRuleRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_pricing_rules')) {
            return redirect('admin/index');
        }

        $pricingRule = PricingRule::findOrFail($id);


        $input['name']        = $request->name;
        $input['description'] = $request->description;
        $input['type']        = $request->type;
        $input['zone']        = $request->zone;
        $input['min_weight']  = $request->min_weight;
        $input['max_weight']  = $request->max_weight;
        $input['max_length']  = $request->max_length;
        $input['max_width']   = $request->max_width;
        $input['max_height']  = $request->max_height;
        $input['base_price']  = $request->base_price;
        $input['price_per_kg']= $request->price_per_kg;
        $input['extra_fee']   = $request->extra_fee;

        // Handle checkboxes
        $input['oversized']   = $request->has('oversized') ? 1 : 0;
        $input['fragile']     = $request->has('fragile') ? 1 : 0;
        $input['perishable']  = $request->has('perishable') ? 1 : 0;
        $input['express']     = $request->has('express') ? 1 : 0;
        $input['same_day']    = $request->has('same_day') ? 1 : 0;
        $input['status']      = $request->has('status') ? 1 : 0;


        $pricingRule->update($input);

        return redirect()->route('admin.pricing_rules.index')->with([
            'message' => __('messages.pricing_rule_updated'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_pricing_rules')) {
            return redirect('admin/index');
        }

        $pricingRule = PricingRule::findOrFail($id);

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
