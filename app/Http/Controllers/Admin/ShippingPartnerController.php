<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ShippingPartnerRequest;
use App\Models\ShippingPartner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class ShippingPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_shipping_partners , show_shipping_partners')) {
            return redirect('admin/index');
        }

        $shipping_partners = ShippingPartner::query()
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

        return view('admin.shipping_partners.index', compact('shipping_partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_shipping_partners')) {
            return redirect('admin/index');
        }


        return view('admin.shipping_partners.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingPartnerRequest $request)
    {

        if (!auth()->user()->ability('admin', 'create_shipping_partners')) {
            return redirect('admin/index');
        }

        // dd($request);

        $input['name']              =   $request->name;
        $input['description']              =   $request->description;
        $input['address']           =   $request->address;

        $input['contact_person']    =   $request->contact_person;
        $input['contact_phone']             =   $request->contact_phone;
        $input['contact_email']             =   $request->contact_email;

        $input['api_url']           =   $request->api_url;
        $input['api_token']           =   $request->api_token;
        $input['auth_type']           =   $request->auth_type;
        $input['credentails']           =   $request->credentails;

        $input['status']            =   $request->status=='on' ? true : false;


        $shipping_partner = ShippingPartner::create($input);

        if($shipping_partner){
            if ($image = $request->file('logo')) {
                $manager = new ImageManager(new Driver());
                $file_name = $shipping_partner->contact_email . '.' . $image->extension();
                $img = $manager->read($request->file('logo'));
                $img->toJpeg(80)->save(base_path('public/assets/shipping_partners/' . $file_name));

                $shipping_partner->update([
                    'logo'  => $file_name,
                ]);

            }
        }


        if($shipping_partner){
            return redirect()->route('admin.shipping_partners.index')->with([
                'message' => __('messages.shipping_partner_created'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.shipping_partners.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);


    }


    public function show($shipping_partner)
    {
        if (!auth()->user()->ability('admin', 'show_shipping_partners')) {
            return redirect('admin/index');
        }

        // جلب بيانات شريك الشحن بناءً على الـ id
        $shipping_partner = ShippingPartner::findOrFail($shipping_partner);

        return view('admin.shipping_partners.show', compact('shipping_partner'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingPartner  $shippingPartner
     * @return \Illuminate\Http\Response
     */
     public function update(ShippingPartnerRequest $request, $shipping_partner)
    {
        if (!auth()->user()->ability('admin', 'update_shipping_partners')) {
            return redirect('admin/index');
        }

        $shipping_partner = ShippingPartner::where('id', $shipping_partner)->first();


        $input['name']              =   $request->name;
        $input['description']              =   $request->description;
        $input['address']           =   $request->address;

        $input['contact_person']    =   $request->contact_person;
        $input['contact_phone']             =   $request->contact_phone;
        $input['contact_email']             =   $request->contact_email;

        $input['api_url']           =   $request->api_url;
        $input['api_token']           =   $request->api_token;
        $input['auth_type']           =   $request->auth_type;
        $input['credentails']           =   $request->credentails;

        $input['status']            =   $request->status=='on' ? true : false;


        $shipping_partner->update($input);

         if($shipping_partner){
            if ($image = $request->file('logo')) {

                if ($shipping_partner->logo != '') {
                    if (File::exists('assets/shipping_partners/' . $shipping_partner->logo)) {
                        unlink('assets/shipping_partners/' . $shipping_partner->logo);
                    }
                }

                $manager = new ImageManager(new Driver());
                $file_name = $shipping_partner->contact_email . '.' . $image->extension();
                $img = $manager->read($request->file('logo'));
                $img->toJpeg(80)->save(base_path('public/assets/shipping_partners/' . $file_name));

                $shipping_partner->update([
                    'logo'  => $file_name,
                ]);

            }
        }


        if($shipping_partner){
            return redirect()->route('admin.shipping_partners.index')->with([
                'message' => __('messages.shipping_partners_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.shipping_partners.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingPartner  $shippingPartner
     * @return \Illuminate\Http\Response
     */
    public function edit($shipping_partner)
    {
        if (!auth()->user()->ability('admin', 'update_shipping_partners')) {
            return redirect('admin/index');
        }

        $shipping_partner = ShippingPartner::where('id', $shipping_partner)->first();


        return view('admin.shipping_partners.edit',compact('shipping_partner'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingPartner  $shippingPartner
     * @return \Illuminate\Http\Response
     */
    public function destroy($shipping_partner)
    {
        if (!auth()->user()->ability('admin', 'shipping_partners')) {
            return redirect('admin/index');
        }

        $shipping_partner = ShippingPartner::where('id', $shipping_partner)->first();

       if ($shipping_partner->logo != '') {
            if (File::exists('assets/shipping_partners/' . $shipping_partner->logo)) {
                unlink('assets/shipping_partners/' . $shipping_partner->logo);
            }
        }

        $shipping_partner->delete();

        if ($shipping_partner) {
            return redirect()->route('admin.shipping_partners.index')->with([
                'message' => __('messages.shipping_partner_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.shipping_partners.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_shipping_partners')) {
            return redirect('admin/index');
        }

        $shipping_partner = ShippingPartner::findOrFail($request->shipping_partner_id);

        if ($shipping_partner->logo != '') {
            if (File::exists('assets/shipping_partners/' . $shipping_partner->logo)) {
                unlink('assets/shipping_partners/' . $shipping_partner->logo);
            }

            $shipping_partner->logo = null;
            $shipping_partner->save();

            return true;
        }
    }

    public function updateShippingPartnerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ShippingPartner::where('id', $data['shipping_partner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'shipping_partner_id' => $data['shipping_partner_id']]);
        }
    }
}
