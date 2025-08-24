<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StockItemRequest;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\RentalShelf;
use App\Models\StockItem;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_stock_items , show_stock_items')) {
            return redirect('admin/index');
        }

        $stock_items = StockItem::with(['merchant', 'product', 'rentalShelf.shelf.warehouse', 'rentalShelf.rental'])
            ->when(request('keyword') != null, function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('name', 'like', '%' . request('keyword') . '%');
                })->orWhereHas('merchant', function ($q) {
                    $q->where('name', 'like', '%' . request('keyword') . '%');
                });
            })
            ->when(request('merchant_id') != null, function ($query) {
                $query->where('merchant_id', request('merchant_id'));
            })
            ->when(request('product_id') != null, function ($query) {
                $query->where('product_id', request('product_id'));
            })
            ->when(request('warehouse_id') != null, function ($query) {
                $query->whereHas('rentalShelf.shelf.warehouse', function ($q) {
                    $q->where('id', request('warehouse_id'));
                });
            })
            ->when(request('status') != null, function ($query) {
                $query->where('status', request('status'));
            })
            ->orderByRaw(request('sort_by') == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request('order_by') ?? 'desc')
                : (request('sort_by') ?? 'created_at') . ' ' . (request('order_by') ?? 'desc'))
        ->paginate(request('limit_by') ?? 100);


        return view('admin.stock_items.index', compact('stock_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
        {
            if (!auth()->user()->ability('admin', 'create_stock_items')) {
                return redirect('admin/index');
            }

            $merchants = Merchant::select('id', 'name')->get();


            return view('admin.stock_items.create', compact('merchants'));
        }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(StockItemRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_stock_items')) {
            return redirect('admin/index');
        }


        $data = $request->validated();
        $data['status'] = $request->status == 'on' ? true : false;

        $stockItem = StockItem::create($data);

        return redirect()->route('admin.stock_items.index')->with([
            'message' => __('messages.stock_item_created'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function show(StockItem $stockItem)
    {
        $stockItem->load(['merchant', 'product', 'rentalShelf.shelf.warehouse', 'rentalShelf.rental']);
        return view('admin.stock_items.show', compact('stockItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     if (!auth()->user()->ability('admin', 'update_stock_items')) {
    //         return redirect('admin/index');
    //     }

    //     $stockItem = StockItem::findOrFail($id);
    //     $merchants = Merchant::select('id', 'name')->get();
    //     $products = Product::select('id', 'name')->get();
    //     $rentalShelves = RentalShelf::with('shelf')->get();

    //     return view('admin.stock_items.edit', compact('stockItem', 'merchants', 'products', 'rentalShelves'));
    // }

    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_stock_items')) {
            return redirect('admin/index');
        }

        $stockItem = StockItem::findOrFail($id);
        $merchants = Merchant::select('id', 'name')->get();

        // استبعاد المنتجات المخزنة مسبقاً ما عدا المنتج الحالي
        $storedProductIds = StockItem::where('merchant_id', $stockItem->merchant_id)
            ->where('id', '!=', $stockItem->id)
            ->pluck('product_id')
            ->toArray();

        $products = Product::where('merchant_id', $stockItem->merchant_id)
            ->whereNotIn('id', $storedProductIds)
            ->orWhere('id', $stockItem->product_id) // السماح بعرض المنتج الحالي
            ->select('id', 'name')
            ->get();

        $rentalShelves = RentalShelf::with('shelf.warehouse')
            ->whereHas('rental', function($query) use ($stockItem) {
                $query->where('merchant_id', $stockItem->merchant_id);
            })
            ->get();

        return view('admin.stock_items.edit', compact('stockItem', 'merchants', 'products', 'rentalShelves'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function update(StockItemRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_stock_items')) {
            return redirect('admin/index');
        }

        $stockItem = StockItem::findOrFail($id);
        $data = $request->validated();
        $data['status'] = $request->status == 'on' ? true : false;

        $stockItem->update($data);

        return redirect()->route('admin.stock_items.index')->with([
            'message' => __('messages.stock_item_updated'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_stock_items')) {
            return redirect('admin/index');
        }

        $stockItem = StockItem::findOrFail($id);
        $stockItem->delete();

        return redirect()->route('admin.stock_items.index')->with([
            'message' => __('messages.stock_item_deleted'),
            'alert-type' => 'success'
        ]);
    }

    public function fetchMerchantData(Request $request)
    {
        $merchantId = $request->merchant_id;

        // المنتجات الخاصة بالتاجر والتي ليست مخزنة مسبقاً
        $storedProductIds = StockItem::where('merchant_id', $merchantId)->pluck('product_id')->toArray();

        $products = Product::where('merchant_id', $merchantId)
            ->whereNotIn('id', $storedProductIds)
            ->select('id', 'name')
        ->get();

        // رفوف التاجر المؤجرة
        // $rentalShelves = \App\Models\RentalShelf::with('shelf.warehouse')
        //     ->where('merchant_id', $merchantId)
        //     ->get()
        //     ->map(function ($rentalShelf) {
        //         return [
        //             'id' => $rentalShelf->id,
        //             'code' => $rentalShelf->shelf->code ?? '',
        //             'warehouse' => $rentalShelf->shelf->warehouse->name ?? '',
        //         ];
        // });

        $rentalShelves = \App\Models\RentalShelf::with('shelf.warehouse')
            ->whereHas('rental', function($query) use ($merchantId) {
                $query->where('merchant_id', $merchantId);
            })
            ->get()
            ->map(function ($rentalShelf) {
                return [
                    'id' => $rentalShelf->id,
                    'code' => $rentalShelf->shelf->code ?? '',
                    'warehouse' => $rentalShelf->shelf->warehouse->name ?? '',
                ];
        });


        return response()->json([
            'products' => $products,
            'rental_shelves' => $rentalShelves,
        ]);
    }


    public function updateStockItemStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            StockItem::where('id', $data['stock_item_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'stock_item_id' => $data['stock_item_id']]);
        }
    }

}
