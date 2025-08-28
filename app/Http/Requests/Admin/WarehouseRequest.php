<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest
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
                        'manager.ar'                        =>  'required|string|max:255',

                        'code'                              =>  'required|string|max:20|unique:warehouses',
                        'phone'                             =>  'required|string|max:20',
                        'email'                             =>  'required|email|max:255|unique:warehouses',


                        'country'       => 'required|string|max:255',
                        'region'        => 'required|string|max:255',
                        'city'          => 'required|string|max:255',
                        'district'      => 'required|string|max:255',
                        'latitude'      => 'required|numeric|between:-90,90',
                        'longitude'     => 'required|numeric|between:-180,180',


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
                        'manager.ar'                        =>  'required|string|max:255',

                        'code'                              =>  'required|string|max:20|unique:warehouses,code,'.$this->route()->warehouse,
                        'phone'                             =>  'required|string|max:20',
                        'email'                             =>  'required|email|max:255|unique:warehouses,email,'.$this->route()->warehouse,


                        'country'       => 'required|string|max:255',
                        'region'        => 'required|string|max:255',
                        'city'          => 'required|string|max:255',
                        'district'      => 'required|string|max:255',
                        'latitude'      => 'required|numeric|between:-90,90',
                        'longitude'     => 'required|numeric|between:-180,180',


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
            'code'         => '( ' . __('warehouse.code') . ' )',
            'phone'         => '( ' . __('warehouse.phone') . ' )',
            'email'       => '( ' . __('warehouse.email') . ' )',

            'country'   => "( " . __('warehouse.country') . " )",
            'region'    => "( " . __('warehouse.region') . " )",
            'city'      => "( " . __('warehouse.city') . " )",
            'district'  => "( " . __('warehouse.district') . " )",
            'latitude'  => "( " . __('warehouse.latitude') . " )",
            'longitude' => "( " . __('warehouse.longitude') . " )",

        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += ['name.' . $key       =>  "( " . __('warehouse.name')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['location.' . $key       =>  "( " . __('warehouse.location')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
            $attr += ['manager.' . $key       =>  "( " . __('warehouse.manager')   . ' ' . __('panel.in') . ' ' . __('panel.' . $val['lang'])   . " )",];
        }

        return $attr;
    }
}
