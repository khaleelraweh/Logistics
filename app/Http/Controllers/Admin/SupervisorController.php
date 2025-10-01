<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\Facades\Image;
use illuminate\support\Str;
use App\Models\Role;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SupervisorRequest;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class SupervisorController extends Controller
{
    public function index()
    {
        if(!auth()->user()->ability('admin','manage_supervisors , show_supervisors')){
            return redirect('admin/index');
        }

        //get users where has roles
        $supervisors = User::whereHas('roles', function($query){
            $query->where('name','supervisor');
        })
        ->when(\request()->keyword != null , function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null , function($query){
            $query->where('status',\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);

        return view('admin.supervisors.index',compact('supervisors'));

    }

    public function create()
    {
        if(!auth()->user()->ability('admin','create_supervisors')){
            return redirect('admin/index');
        }

        $permissions = Permission::get(['id','display_name']);

        return view('admin.supervisors.create',compact('permissions'));
    }

    public function store(SupervisorRequest $request)
    {
        if(!auth()->user()->ability('admin','create_supervisors')){
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['password'] = bcrypt($request->password);
        $input['status'] = $request->status;


        if ($image = $request->file('user_image')) {
            $manager = new ImageManager(new Driver());

            $file_name = Str::slug($request->username).".".$image->getClientOriginalExtension();

            $img = $manager->read($request->file('user_image'));
            $img->toJpeg(100)->save(public_path('assets/users/' . $file_name));
            $input['user_image'] = $file_name;
        }

        $supervisor = User::create($input);
        $supervisor->markEmailAsVerified();
        $supervisor->attachRole(Role::whereName('supervisor')->first()->id);

        //add permissions
        if(isset($request->permissions) && count($request->permissions) > 0){
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message' => __('message.CreatedSuccessfully'),
            'alert-type' => 'success'
        ]);
    }

    public function show(User $supervisor)
    {
        if(!auth()->user()->ability('admin','display_supervisors')){
            return redirect('admin/index');
        }
        return view('admin.supervisors.show',compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        if(!auth()->user()->ability('admin','update_supervisors')){
            return redirect('admin/index');
        }

        $permissions = Permission::get(['id','display_name']);
        $supervisorPermissions = UserPermissions::whereUserId($supervisor->id)->pluck('permission_id')->toArray();

        return view('admin.supervisors.edit',compact('supervisor','permissions','supervisorPermissions'));
    }

    public function update(SupervisorRequest $request, User $supervisor)
    {
        if(!auth()->user()->ability('admin','update_supervisors')){
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        if(trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }
        $input['status'] = $request->status;

        if ($image = $request->file('user_image')) {

            if($supervisor->user_image != null && File::exists('assets/users/' . $supervisor->user_image)){
                unlink('assets/supervisors/' . $supervisor->user_image);
            }

            $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension();
            $path = public_path('assets/users/'.$file_name);
            Image::make($image->getRealPath())->resize(500,null,function($constraint){
                $constraint->aspectRatio();
            })->save($path);

            $input['user_image'] = $file_name;
        }

        $supervisor->update($input);
        //update permission
        //add permissions
        if(isset($request->permissions) && count($request->permissions) > 0){
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message' => __('message.UpdatedSuccessfully'),
            'alert-type' => 'success'
        ]);
    }

    public function destroy(User $supervisor)
    {
        if(!auth()->user()->ability('admin','delete_supervisors')){
            return redirect('admin/index');
        }

        // first: delete image from users path
        if(File::exists('assets/users/' . $supervisor->user_image)){
            unlink('assets/users/' . $supervisor->user_image);
        }
        //second : delete supervisor from users table
        $supervisor->delete();

        return redirect()->route('admin.supervisors.index')->with([
            'message' => __('message.DeletedSuccessfully'),
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request){

        if(!auth()->user()->ability('admin','delete_supervisors')){
            return redirect('admin/index');
        }

        $supervisor = User::findOrFail($request->supervisor_id);
        if(File::exists('assets/users/' . $supervisor->user_image)){
            unlink('assets/users/' . $supervisor->user_image);
            $supervisor->user_image = null;
            $supervisor->save();
        }
        if($supervisor->user_image != null){
            $supervisor->user_image = null;
            $supervisor->save();
        }

        return true;
    }
}
