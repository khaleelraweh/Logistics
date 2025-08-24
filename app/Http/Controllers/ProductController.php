<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_products , show_products')) {
            return redirect('admin/index');
        }

        $products = Product::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderByRaw(request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
        ->paginate(\request()->limit_by ?? 100);




        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }

        $merchants = Merchant::whereStatus(1)->get(['id', 'name','email']);

        return view('admin.products.create',compact('merchants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        if (!auth()->user()->ability('admin', 'create_products')) {
            return redirect('admin/index');
        }

        // dd($request);

        $input['name']              =   $request->name;
        $input['merchant_id']       =   $request->merchant_id;
        $input['description']       =   $request->description;
        $input['sku']               =   $request->sku;
        $input['status']            =   $request->status=='on' ? true : false;

        $product = Product::create($input);

        if($product){
            if ($request->hasFile('images') && count($request->images) > 0) {

                $i = $product->photos->count() + 1;
                $images = $request->file('images');

                foreach ($images as $image) {
                    $manager = new ImageManager(new Driver());

                    $file_name = $product->sku . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();

                    $img = $manager->read($image);
                    $img->save(base_path('public/assets/products/' . $file_name));

                    $product->photos()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => 'true',
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
        }

        if($product){
            return redirect()->route('admin.products.index')->with([
                'message' => __('messages.product_created'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.products.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::where('id', $product)->first();
        return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function edit(Product $product)
    public function edit($product)
    {
        if (!auth()->user()->ability('admin', 'update_products')) {
            return redirect('admin/index');
        }

        $merchants = Merchant::whereStatus(1)->get(['id', 'name','email']);

        $product = Product::where('id', $product)->first();

        return view('admin.products.edit',compact('product','merchants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        if (!auth()->user()->ability('admin', 'update_products')) {
            return redirect('admin/index');
        }

        $product = Product::where('id', $product)->first();

        // dd($request);

        $input['name']              =   $request->name;
        $input['merchant_id']       =   $request->merchant_id;
        $input['description']       =   $request->description;
        $input['sku']               =   $request->sku;
        $input['status']            =   $request->status=='on' ? true : false;

        $product->update($input);



        if($product){
            if ($request->hasFile('images') && count($request->images) > 0) {

                //Delete photos from directory and photo

                if ($product->photos->count()>0) {
                    foreach($product->photos as $photo){
                        if (File::exists('public/assets/products/' . $photo->file_name)) {
                            unlink('public/assets/products/' . $photo->file_name);
                        }
                        $photo->delete();
                    }
                }

                // end Delete photos from directory and photo


                $i = $product->photos->count() + 1;
                $images = $request->file('images');
                foreach ($images as $image) {
                    $manager = new ImageManager(new Driver());

                    $file_name = $product->sku . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();

                    $img = $manager->read($image);
                    $img->save(base_path('public/assets/products/' . $file_name));

                    $product->photos()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => 'true',
                        'file_sort' => $i,
                    ]);
                    $i++;
                }
            }
        }




        if($product){
            return redirect()->route('admin.products.index')->with([
                'message' => __('messages.product_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.products.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy($product)
    {
        if (!auth()->user()->ability('admin', 'delete_products')) {
            return redirect('admin/index');
        }

        $product = Product::where('id', $product)->first();
        if ($product->photos->count() > 0) {
            foreach ($product->photos as $photo) {
                if (File::exists('assets/products/' . $photo->file_name)) {
                    unlink('assets/products/' . $photo->file_name);
                }
                $photo->delete();
            }
        }

        $product->delete();

        if ($product) {
            return redirect()->route('admin.products.index')->with([
                'message' => __('messages.product_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.products.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    // did not remove image from the folder
    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_products')) {
            return redirect('admin/index');
        }
        $product = Product::findOrFail($request->product_id);

        $image = $product->photos()->where('id', $request->image_id)->first();

        if (File::exists('assets/products/' . $image->file_name)) {
            unlink('assets/products/' . $image->file_name);
        }

        $image->delete();
        return true;
    }


    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
}
