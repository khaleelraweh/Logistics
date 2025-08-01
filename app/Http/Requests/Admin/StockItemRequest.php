<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StockItemRequest extends FormRequest
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
            'merchant_id' => 'required|exists:merchants,id',
            'product_id' => 'required|exists:products,id',
            'rental_shelf_id' => 'required|exists:rental_shelves,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'nullable'
        ];
    }
}
