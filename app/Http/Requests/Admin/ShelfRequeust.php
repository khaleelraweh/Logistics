<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShelfRequeust extends FormRequest
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
                        'warehouse_id'                      =>  'required',
                        'code'                              =>  'required|string|max:255|unique:shelves',
                        'description'                       =>  'required|string|max:255',
                        'size'                              =>  'required|string|max:255',
                        'price'                             =>  'required|string',

                        'status'                            =>  'nullable',
                        'created_by'                        =>  'nullable',
                        'updated_by'                        =>  'nullable',
                        'deleted_by'                        =>  'nullable',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'warehouse_id'                      =>  'required',
                        'code'                              =>  'required|string|max:255|unique:shelves,code,'.$this->route()->shelf,
                        'description'                       =>  'required|string|max:255',
                        'size'                              =>  'required|string|max:255',
                        'price'                             =>  'required|string',

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
            'code'              => '( ' . __('shelf.code') . ' )',
            'warehouse_id'      => '( ' . __('warehouse.name') . ' )',
            'description'       => '( ' . __('shelf.description') . ' )',
            'size'              => '( ' . __('shelf.size') . ' )',
            'price'             => '( ' . __('shelf.price') . ' )',
            'status'            => '( ' . __('general.status') . ' )',
            'created_at'        => '( ' . __('general.created_at') . ' )',
        ];
        return $attr;
    }
}
