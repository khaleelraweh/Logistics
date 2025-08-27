<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\MerchantRequest;
use App\Models\Merchant;
use App\Models\Package;
use App\Models\PackageProduct;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_merchants , show_merchants')) {
            return redirect('admin/index');
        }

        $merchants = Merchant::query()
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

        return view('admin.merchants.index', compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_merchants')) {
            return redirect('admin/index');
        }

        return view('admin.merchants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(MerchantRequest $request)
    // {

    //     if (!auth()->user()->ability('admin', 'create_merchants')) {
    //         return redirect('admin/index');
    //     }

    //     // dd($request);

    //     $input['name']              =   $request->name;
    //     $input['contact_person']    =   $request->contact_person;
    //     $input['address']           =   $request->address;
    //     $input['phone']             =   $request->phone;
    //     $input['email']             =   $request->email;
    //     $input['api_key']           =   $request->api_key;

    //     $input['status']            =   $request->status=='on' ? true : false;

    //     $input['facebook']      =   $request->facebook;
    //     $input['twitter']       =   $request->twitter;
    //     $input['instagram']     =   $request->instagram;
    //     $input['linkedin']      =   $request->linkedin;
    //     $input['youtube']       =   $request->youtube;
    //     $input['website']       =   $request->website;

    //     $merchant = Merchant::create($input);

    //     if($merchant){
    //         if ($image = $request->file('logo')) {
    //             $manager = new ImageManager(new Driver());
    //             $file_name = $merchant->email . '.' . $image->extension();
    //             $img = $manager->read($request->file('logo'));
    //             $img->toJpeg(80)->save(base_path('public/assets/merchants/' . $file_name));

    //             $merchant->update([
    //                 'logo'  => $file_name,
    //             ]);

    //         }
    //     }


    //     if($merchant){
    //         return redirect()->route('admin.merchants.index')->with([
    //             'message' => __('messages.merchant_created'),
    //             'alert-type' => 'success'
    //         ]);

    //     }

    //     return redirect()->route('admin.merchants.index')->with([
    //         'message' => __('messages.something_went_wrong'),
    //         'alert-type' => 'danger'
    //     ]);


    // }


    public function store(MerchantRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_merchants')) {
            return redirect('admin/index');
        }

        $input = [
            'name'           => $request->name,
            'contact_person' => $request->contact_person,

            'country'        => $request->country,
            'region'         => $request->region,
            'city'           => $request->city,
            'district'       => $request->district,
            'postal_code'    => $request->postal_code,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,

            'others'         => $request->others,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'api_key'        => $request->api_key,
            'status'         => $request->status == 'on' ? true : false,
            'facebook'       => $request->facebook,
            'twitter'        => $request->twitter,
            'instagram'      => $request->instagram,
            'linkedin'       => $request->linkedin,
            'youtube'        => $request->youtube,
            'website'        => $request->website,
        ];

        $merchant = Merchant::create($input);

        if ($merchant && $request->hasFile('logo')) {
            $manager = new ImageManager(new Driver());
            $file_name = $merchant->email . '.' . $request->file('logo')->extension();
            $img = $manager->read($request->file('logo'));
            $img->toJpeg(80)->save(public_path('assets/merchants/' . $file_name));

            $merchant->update(['logo' => $file_name]);
        }

        if ($merchant) {
            return redirect()->route('admin.merchants.index')->with([
                'message' => __('messages.merchant_created'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.merchants.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show($merchant)
    {
        $merchant = Merchant::where('id', $merchant)->first();
        return view('admin.merchants.show',compact('merchant'));
    }
    public function showBackup($merchant)
    {
        $merchant = Merchant::where('id', $merchant)->first();
        return view('admin.merchants.showbackup',compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    // public function edit(Merchant $merchant)
    public function edit($merchant)
    {
        if (!auth()->user()->ability('admin', 'update_merchants')) {
            return redirect('admin/index');
        }

        $merchant = Merchant::where('id', $merchant)->first();

        return view('admin.merchants.edit',compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    // public function update(MerchantRequest $request, $merchant)
    // {
    //     if (!auth()->user()->ability('admin', 'update_merchants')) {
    //         return redirect('admin/index');
    //     }

    //     $merchant = Merchant::where('id', $merchant)->first();

    //     $input['name']              =   $request->name;
    //     $input['contact_person']    =   $request->contact_person;
    //     $input['address']           =   $request->address;
    //     $input['phone']             =   $request->phone;
    //     $input['email']             =   $request->email;
    //     $input['api_key']           =   $request->api_key;

    //     $input['status']            =   $request->status=='on' ? true : false;

    //     $input['facebook']      =   $request->facebook;
    //     $input['twitter']       =   $request->twitter;
    //     $input['instagram']     =   $request->instagram;
    //     $input['linkedin']      =   $request->linkedin;
    //     $input['youtube']       =   $request->youtube;
    //     $input['website']       =   $request->website;

    //     $merchant->update($input);

    //      if($merchant){
    //         if ($image = $request->file('logo')) {

    //             if ($merchant->logo != '') {
    //                 if (File::exists('assets/merchants/' . $merchant->logo)) {
    //                     unlink('assets/merchants/' . $merchant->logo);
    //                 }
    //             }

    //             $manager = new ImageManager(new Driver());
    //             $file_name = $merchant->email . '.' . $image->extension();
    //             $img = $manager->read($request->file('logo'));
    //             $img->toJpeg(80)->save(base_path('public/assets/merchants/' . $file_name));

    //             $merchant->update([
    //                 'logo'  => $file_name,
    //             ]);

    //         }
    //     }


    //     if($merchant){
    //         return redirect()->route('admin.merchants.index')->with([
    //             'message' => __('messages.merchant_updated'),
    //             'alert-type' => 'success'
    //         ]);

    //     }

    //     return redirect()->route('admin.merchants.index')->with([
    //         'message' => __('messages.something_went_wrong'),
    //         'alert-type' => 'danger'
    //     ]);

    // }


    public function update(MerchantRequest $request, $merchant)
{
    if (!auth()->user()->ability('admin', 'update_merchants')) {
        return redirect('admin/index');
    }

    $merchant = Merchant::findOrFail($merchant);

    $input['name']           = $request->name;
    $input['contact_person'] = $request->contact_person;

    // الحقول الجديدة للموقع
    $input['country']      = $request->country;
    $input['region']       = $request->region;
    $input['city']         = $request->city;
    $input['district']     = $request->district;
    $input['postal_code']  = $request->postal_code;
    $input['latitude']     = $request->latitude;
    $input['longitude']    = $request->longitude;
    $input['others']       = $request->others;

    $input['phone']        = $request->phone;
    $input['email']        = $request->email;
    $input['api_key']      = $request->api_key;

    $input['status']       = $request->status == 'on' ? true : false;

    $input['facebook']     = $request->facebook;
    $input['twitter']      = $request->twitter;
    $input['instagram']    = $request->instagram;
    $input['linkedin']     = $request->linkedin;
    $input['youtube']      = $request->youtube;
    $input['website']      = $request->website;

    $merchant->update($input);

    // تحديث الشعار
    if ($image = $request->file('logo')) {
        if ($merchant->logo && file_exists(public_path('assets/merchants/' . $merchant->logo))) {
            unlink(public_path('assets/merchants/' . $merchant->logo));
        }

        $manager = new ImageManager(new Driver());
        $file_name = $merchant->email . '.' . $image->extension();
        $img = $manager->read($image);
        $img->toJpeg(80)->save(public_path('assets/merchants/' . $file_name));

        $merchant->update(['logo' => $file_name]);
    }

    return redirect()->route('admin.merchants.index')->with([
        'message' => __('messages.merchant_updated'),
        'alert-type' => 'success'
    ]);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy($merchant)
    {
        if (!auth()->user()->ability('admin', 'delete_merchants')) {
            return redirect('admin/index');
        }

        $merchant = Merchant::where('id', $merchant)->first();

       if ($merchant->logo != '') {
            if (File::exists('assets/merchants/' . $merchant->logo)) {
                unlink('assets/merchants/' . $merchant->logo);
            }
        }

        $merchant->delete();

        if ($merchant) {
            return redirect()->route('admin.merchants.index')->with([
                'message' => __('messages.merchant_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.merchants.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_merchants')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $merchant = Merchant::findOrFail($request->key); // key = merchant id

        if ($merchant->logo && File::exists(public_path('assets/merchants/' . $merchant->logo))) {
            File::delete(public_path('assets/merchants/' . $merchant->logo));
            $merchant->logo = null;
            $merchant->save();
        }

        return response()->json(['success' => true]);
    }



    public function updateMerchantStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Merchant::where('id', $data['merchant_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'merchant_id' => $data['merchant_id']]);
        }
    }
}
