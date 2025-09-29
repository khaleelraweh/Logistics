<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Merchant\ProfileSettingRequest;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{

    //============================= driver Profile setting ==================//
      public function profile()
    {
        return view('merchant.profile.profile_settings');
    }

    public function update_profile(ProfileSettingRequest $request)
    {

        $user = auth()->user();
        $input['first_name'] =   $request->first_name;
        $input['last_name']  =   $request->last_name;
        $input['username']   =   $request->username;
        $input['email']      =   $request->email;
        $input['mobile']     =   $request->mobile;

        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $input['password'] = bcrypt($request->password);
        }

        $input['facebook']     =   $request->facebook;
        $input['twitter']     =   $request->twitter;
        $input['instagram']     =   $request->instagram;
        $input['linkedin']     =   $request->linkedin;
        $input['youtube']     =   $request->youtube;
        $input['website']     =   $request->website;

        if ($image = $request->file('user_image')) {

            if ($user->user_image != '') {
                if (File::exists('assets/users/' . $user->user_image)) {
                    unlink('assets/users/' . $user->user_image);
                }
            }

            $manager = new ImageManager(new Driver());
            $file_name = $user->username . '.' . $image->extension();
            $img = $manager->read($request->file('user_image'));
            $img->toJpeg(80)->save(base_path('public/assets/users/' . $file_name));
            $input['user_image'] = $file_name;
        }

        $user->update($input);


        if($user){
            return redirect()->route('merchant.profile')->with([
                'message' => __('messages.profile_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('merchant.profile')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    public function remove_image(Request $request)
    {

        $user = auth()->user();

        if ($user->user_image != '') {
            if (File::exists('assets/users/' . $user->user_image)) {
                unlink('assets/users/' . $user->user_image);
            }

            $user->user_image = null;
            $user->save();

            return true;
        }
    }


    //=============================== Layout customizer controller ==================//
    //using layout-customizer liveware
    public function layoutCustomizer()
    {
        return view('merchant.profile.layout-customizer');
    }

    // update mode from right bar using ajax
    public function updateModeFromRightBar(Request $request)
    {
        $user = auth()->user();
        $prefs = $request->input('layout_preferences', []);
        $user->layout_preferences = $prefs;
        $user->save();

        return response()->json(['status' => 'success']);
    }

}
