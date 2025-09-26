<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                        'name'                              =>  'required|string|max:255',
                        'description'                       =>  'nullable|string|max:255',
                        'sku'                               =>  'required|string|max:255|unique:products',

                        'images'                            =>  'required',
                        'images.*'                          =>  'mimes:jpg,jpeg,png,gif,webp|max:3000',

                        'status'                            =>  'nullable',
                        'created_by'                        =>  'nullable',
                        'updated_by'                        =>  'nullable',
                        'deleted_by'                        =>  'nullable',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'                              =>  'required|string|max:255',
                        'description'                       =>  'nullable|string|max:255',
                        'sku'                               =>  'required|string|max:255|unique:products,sku,'. $this->route()->product,

                        'images'                            =>  'nullable',
                        'images.*'                          =>  'mimes:jpg,jpeg,png,gif,webp|max:3000',

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
            'name'          => '( ' . __('product.name') . ' )',
            'merchant_id'   => '( ' . __('merchant.name') . ' )',
            'description'   => '( ' . __('product.description') . ' )',
            'sku'           => '( ' . __('product.sku') . ' )',
            'images'        => '( ' . __('product.images') . ' )',
            'status'        => '( ' . __('general.status') . ' )',
            'created_at'    => '( ' . __('general.created_at') . ' )',
        ];
        return $attr;
    }
}
