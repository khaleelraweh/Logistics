<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name.ar'                           =>  'required|string|max:255',
                        'contact_person.ar'                 =>  'required|string|max:255',
                        'phone'                             =>  'required|string|max:20|unique:merchants',
                        'email'                             =>  'required|email|max:255|unique:merchants',
                        'api_key'                           =>  'nullable',
                        'logo'                              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                        'facebook'                          => 'nullable|url',
                        'twitter'                           => 'nullable|url',
                        'instagram'                         => 'nullable|url',
                        'linkedin'                          => 'nullable|url',
                        'youtube'                           => 'nullable|url',
                        'website'                           => 'nullable|url',


                        'status'                            =>  'nullable',
                        'created_by'                        =>  'nullable',
                        'updated_by'                        =>  'nullable',
                        'deleted_by'                        =>  'nullable',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name.ar'                           =>  'required|string|max:255',
                        'contact_person.ar'                 =>  'required|string|max:255',
                        'phone'                             =>  'required|string|max:20|unique:merchants,phone,'.$this->route()->merchant,
                        'email'                             =>  'required|email|max:255|unique:merchants,email,'.$this->route()->merchant,
                        'api_key'                           =>  'nullable',
                        'logo'                              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                        'facebook'                          => 'nullable|url',
                        'twitter'                           => 'nullable|url',
                        'instagram'                         => 'nullable|url',
                        'linkedin'                          => 'nullable|url',
                        'youtube'                           => 'nullable|url',
                        'website'                           => 'nullable|url',


                        'status'                            =>  'nullable',
                        'created_by'                        =>  'nullable',
                        'updated_by'                        =>  'nullable',
                        'deleted_by'                        =>  'nullable',
                    ];
                }

            default:
                break;
        }
    }

    public function attributes(): array
    {
        $attr = [
            'phone'         => '( ' . __('general.phone') . ' )',
            'email'         => '( ' . __('general.email') . ' )',
            'api_key'       => '( ' . __('general.api_key') . ' )',
            'logo'          => '( ' . __('merchant.logo') . ' )',
            'status'        => '( ' . __('general.status') . ' )',
            'created_at'    => '( ' . __('general.created_at') . ' )',


            'facebook'      => '( ' . __('general.facebook') . ' )',
            'twitter'       => '( ' . __('general.twitter') . ' )',
            'instagram'     => '( ' . __('general.instagram') . ' )',
            'linkedin'      => '( ' . __('general.linkedin') . ' )',
            'youtube'       => '( ' . __('general.youtube') . ' )',
            'website'       => '( ' . __('general.website') . ' )',
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['name.' . $key       =>  "( " . __('merchant.name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['contact_person.' . $key       =>  "( " . __('merchant.contact_person')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }

        return $attr;
    }
}
