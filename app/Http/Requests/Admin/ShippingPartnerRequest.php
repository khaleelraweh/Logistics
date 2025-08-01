<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingPartnerRequest extends FormRequest
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
                        'description.ar'                           =>  'required|string|max:255',
                        'address.ar'                         =>  'required|string|max:255',
                        'contact_person.ar'                           =>  'required|string|max:255',

                        'contact_email'                             =>  'required|email|max:255|unique:shipping_partners',
                        'contact_phone'                             =>  'required|string|max:20|unique:shipping_partners',

                        'api_url'                           =>  'nullable',
                        'api_token'                           =>  'nullable',
                        'auth_type'                           =>  'nullable',
                        'credentails'                           =>  'nullable',

                        'logo'                              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

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
                        'description.ar'                           =>  'required|string|max:255',
                        'address.ar'                         =>  'required|string|max:255',
                        'contact_person.ar'                           =>  'required|string|max:255',

                        'contact_email'                             =>  'required|email|max:255|unique:shipping_partners,contact_email,'.$this->route()->shipping_partner,
                        'contact_phone'                             =>  'required|string|max:20|unique:shipping_partners,contact_phone,'.$this->route()->shipping_partner,

                        'api_url'                           =>  'nullable',
                        'api_token'                           =>  'nullable',
                        'auth_type'                           =>  'nullable',
                        'credentails'                           =>  'nullable',

                        'logo'                              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

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
            'contact_phone'         => '( ' . __('shipping_partner.contact_phone') . ' )',
            'contact_email'         => '( ' . __('shipping_partner.contact_email') . ' )',
            'api_key'       => '( ' . __('shipping_partner.api_key') . ' )',
            'logo'          => '( ' . __('shippint_partner.logo') . ' )',
            'status'        => '( ' . __('shipping_partner.status') . ' )',
            'created_at'    => '( ' . __('shipping_partner.created_at') . ' )',


        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['name.' . $key       =>  "( " . __('shipping_partner.name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['description.' . $key       =>  "( " . __('shipping_partner.description')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['address.' . $key       =>  "( " . __('shipping_partner.address')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['contact_person.' . $key       =>  "( " . __('shipping_partner.contact_person')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }

        return $attr;
    }
}
