<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverRequest;
use App\Models\Driver as DriverModel;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_drivers , show_drivers')) {
    //         return redirect('admin/index');
    //     }

    //     $drivers = DriverModel::query()
    //         ->when(\request()->keyword != null, function ($query) {
    //             $query->search(\request()->keyword);
    //         })
    //         ->when(\request()->status != null, function ($query) {
    //             $query->where('status', \request()->status);
    //         })
    //         ->orderByRaw(request()->sort_by == 'published_on'
    //             ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //             : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
    //         ->paginate(\request()->limit_by ?? 100);

    //     return view('admin.drivers.index', compact('drivers'));
    // }

    public function index()
{
    if (!auth()->user()->ability('admin', 'manage_drivers , show_drivers')) {
        return redirect('admin/index');
    }

    // جلب المشرفين للفلتر
    $supervisors = User::whereHas('roles', function($query) {
        $query->where('name', 'supervisor');
    })->get();

    $drivers = DriverModel::query()
        ->when(request()->keyword != null, function ($query) {
            $query->search(request()->keyword);
        })
        ->when(request()->status != null, function ($query) {
            $query->where('status', request()->status);
        })
        ->when(request()->availability_status != null, function ($query) {
            $query->where('availability_status', request()->availability_status);
        })
        ->when(request()->vehicle_type != null, function ($query) {
            $query->where('vehicle_type', request()->vehicle_type);
        })
        ->when(request()->supervisor_id != null, function ($query) {
            $query->where('supervisor_id', request()->supervisor_id);
        })
        ->when(request()->city != null, function ($query) {
            $query->where('city', 'like', '%' . request()->city . '%');
        })
        ->when(request()->region != null, function ($query) {
            $query->where('region', 'like', '%' . request()->region . '%');
        })
        ->orderByRaw(
            request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
        )
        ->paginate(request()->limit_by ?? 100);

    return view('admin.drivers.index', compact('drivers', 'supervisors'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_drivers')) {
            return redirect('admin/index');
        }

        $supervisors = User::WhereHasRoles('supervisor')->active()->get(['id', 'first_name', 'last_name' , 'email']);


        return view('admin.drivers.create' , compact('supervisors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_drivers')) {
            return redirect('admin/index');
        }

        $input['first_name']                  =   $request->first_name;
        $input['middle_name']                  =   $request->middle_name;
        $input['last_name']                  =   $request->last_name;

        $input['phone']                 =   $request->phone;
        $input['username']              =   $request->username;
        $input['email']                 =   $request->email;
        $input['password']              =   $request->password;

        $input['country']               =  $request->country;
        $input['region']               =  $request->region;
        $input['city']               =  $request->city;
        $input['district']               =  $request->district;
        $input['latitude']               =  $request->latitude;
        $input['longitude']               =  $request->longitude;

        $input['vehicle_type']              =   $request->vehicle_type;
        $input['vehicle_number']            =   $request->vehicle_number;
        $input['vehicle_model']             =   $request->vehicle_model;
        $input['vehicle_color']             =   $request->vehicle_color;
        $input['vehicle_capacity_weight']   =   $request->vehicle_capacity_weight;
        $input['vehicle_capacity_volume']   =   $request->vehicle_capacity_volume;

        $input['license_number']        =   $request->license_number;
        $input['license_expiry_date']   =   $request->license_expiry_date;
        $input['hired_date']            =   $request->hired_date;

        $input['supervisor_id']         =   $request->supervisor_id;
        $input['availability_status']   =   $request->availability_status;
        $input['status']                =   $request->status;
        $input['reason']                =   $request->reason;

        $input['created_by']                =   auth()->user()->full_name;


        $driver = DriverModel::create($input);

        if($driver){
            if ($image = $request->file('driver_image')) {
                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_driver_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('driver_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'driver_image'  => $file_name,
                ]);

            }
            if ($image = $request->file('vehicle_image')) {
                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_vehicle_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('vehicle_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'vehicle_image'  => $file_name,
                ]);

            }
            if ($image = $request->file('license_image')) {
                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_license_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('license_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'license_image'  => $file_name,
                ]);

            }
            if ($image = $request->file('id_card_image')) {
                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_id_card_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('id_card_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'id_card_image'  => $file_name,
                ]);

            }
        }

        if($driver){
            return redirect()->route('admin.drivers.index')->with([
                'message' => __('messages.driver_created'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.drivers.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show($driver)
    {
        if (!auth()->user()->ability('admin', 'show_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::findOrFail($driver);
        return view('admin.drivers.show', compact('driver'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    // public function edit(Warehouse $warehouse)
    public function edit($driver)
    {
        if (!auth()->user()->ability('admin', 'update_drivers')) {
            return redirect('admin/index');
        }

        $supervisors = User::WhereHasRoles('supervisor')->active()->get(['id', 'first_name', 'last_name' , 'email']);

        $driver = DriverModel::where('id', $driver)->first();

        return view('admin.drivers.edit',compact('driver' , 'supervisors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, $driver)
    {
        if (!auth()->user()->ability('admin', 'update_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::where('id', $driver)->first();


        $input['first_name']                  =   $request->first_name;
        $input['middle_name']                  =   $request->middle_name;
        $input['last_name']                  =   $request->last_name;
        $input['phone']                 =   $request->phone;
        $input['username']              =   $request->username;
        $input['email']                 =   $request->email;
        $input['password']              =   $request->password;

        $input['country']               =  $request->country;
        $input['region']               =  $request->region;
        $input['city']               =  $request->city;
        $input['district']               =  $request->district;
        $input['latitude']               =  $request->latitude;
        $input['longitude']               =  $request->longitude;

        $input['vehicle_type']              =   $request->vehicle_type;
        $input['vehicle_number']            =   $request->vehicle_number;
        $input['vehicle_model']             =   $request->vehicle_model;
        $input['vehicle_color']             =   $request->vehicle_color;
        $input['vehicle_capacity_weight']   =   $request->vehicle_capacity_weight;
        $input['vehicle_capacity_volume']   =   $request->vehicle_capacity_volume;

        $input['license_number']        =   $request->license_number;
        $input['license_expiry_date']   =   $request->license_expiry_date;
        $input['hired_date']            =   $request->hired_date;

        $input['supervisor_id']         =   $request->supervisor_id;
        $input['availability_status']   =   $request->availability_status;
        $input['status']                =   $request->status;
        $input['reason']                =   $request->reason;

        $input['created_by']            =   auth()->user()->full_name;


        $driver->update($input);

        if($driver){

            if ($image = $request->file('driver_image')) {

                if ($driver->driver_image != '') {
                    if (File::exists('assets/drivers/' . $driver->driver_image)) {
                        unlink('assets/drivers/' . $driver->driver_image);
                    }
                }

                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_driver_image_'. time() . '.' . $image->extension();
                $img = $manager->read($request->file('driver_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'driver_image'  => $file_name,
                ]);

            }

            if ($image = $request->file('vehicle_image')) {

                if ($driver->vehicle_image != '') {
                    if (File::exists('assets/drivers/' . $driver->vehicle_image)) {
                        unlink('assets/drivers/' . $driver->vehicle_image);
                    }
                }

                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_vehicle_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('vehicle_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'vehicle_image'  => $file_name,
                ]);

            }

            if ($image = $request->file('license_image')) {

                if ($driver->license_image != '') {
                    if (File::exists('assets/drivers/' . $driver->license_image)) {
                        unlink('assets/drivers/' . $driver->license_image);
                    }
                }

                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_license_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('license_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'license_image'  => $file_name,
                ]);

            }

            if ($image = $request->file('id_card_image')) {

                if ($driver->id_card_image != '') {
                    if (File::exists('assets/drivers/' . $driver->id_card_image)) {
                        unlink('assets/drivers/' . $driver->id_card_image);
                    }
                }

                $manager = new ImageManager(new Driver());
                $file_name = $driver->id.'_id_card_image_' . time() . '.' . $image->extension();
                $img = $manager->read($request->file('id_card_image'));
                $img->toJpeg(80)->save(base_path('public/assets/drivers/' . $file_name));

                $driver->update([
                    'id_card_image'  => $file_name,
                ]);

            }
        }




        if($driver){
            return redirect()->route('admin.drivers.index')->with([
                'message' => __('messages.driver_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.drivers.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($driver)
    {
        if (!auth()->user()->ability('admin', 'delete_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::where('id', $driver)->first();

       if ($driver->driver_image != '') {
            if (File::exists('assets/drivers/' . $driver->driver_image)) {
                unlink('assets/drivers/' . $driver->driver_image);
            }
        }

       if ($driver->vehicle_image != '') {
            if (File::exists('assets/drivers/' . $driver->vehicle_image)) {
                unlink('assets/drivers/' . $driver->vehicle_image);
            }
        }

       if ($driver->license_image != '') {
            if (File::exists('assets/drivers/' . $driver->license_image)) {
                unlink('assets/drivers/' . $driver->license_image);
            }
        }

       if ($driver->id_card_image != '') {
            if (File::exists('assets/drivers/' . $driver->id_card_image)) {
                unlink('assets/drivers/' . $driver->id_card_image);
            }
        }

        $driver->delete();

        if ($driver) {
            return redirect()->route('admin.drivers.index')->with([
                'message' => __('messages.driver_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.drivers.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function remove_driver_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::findOrFail($request->driver_id);

        if ($driver->driver_image != '') {
            if (File::exists('assets/drivers/' . $driver->driver_image)) {
                unlink('assets/drivers/' . $driver->driver_image);
            }

            $driver->driver_image = null;
            $driver->save();

            return true;
        }
    }

    public function remove_vehicle_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::findOrFail($request->driver_id);

        if ($driver->vehicle_image != '') {
            if (File::exists('assets/drivers/' . $driver->vehicle_image)) {
                unlink('assets/drivers/' . $driver->vehicle_image);
            }

            $driver->vehicle_image = null;
            $driver->save();

            return true;
        }
    }

    public function remove_license_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::findOrFail($request->driver_id);

        if ($driver->license_image != '') {
            if (File::exists('assets/drivers/' . $driver->license_image)) {
                unlink('assets/drivers/' . $driver->license_image);
            }

            $driver->license_image = null;
            $driver->save();

            return true;
        }
    }

    public function remove_id_card_image(Request $request)
    {
        if (!auth()->user()->ability('admin', 'delete_drivers')) {
            return redirect('admin/index');
        }

        $driver = DriverModel::findOrFail($request->driver_id);

        if ($driver->id_card_image != '') {
            if (File::exists('assets/drivers/' . $driver->id_card_image)) {
                unlink('assets/drivers/' . $driver->id_card_image);
            }

            $driver->id_card_image = null;
            $driver->save();

            return true;
        }
    }

}
