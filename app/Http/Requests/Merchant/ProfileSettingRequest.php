<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class ProfileSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name.ar' => 'required|string|max:255',
            'last_name.ar'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'email'      => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'mobile'     => 'required|string|max:20|unique:users,mobile,' . auth()->id(),
            'password'   => 'nullable|string|min:6',
            'description' => 'nullable|string',
            'motavation' => 'nullable|string',
            'facebook'   => 'nullable|url',
            'twitter'    => 'nullable|url',
            'instagram'  => 'nullable|url',
            'linkedin'   => 'nullable|url',
            'youtube'    => 'nullable|url',
            'website'    => 'nullable|url',
            'user_image' => 'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000'
        ];
    }
}
