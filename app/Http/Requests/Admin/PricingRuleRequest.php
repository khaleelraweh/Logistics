<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PricingRuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'name.ar'        => 'required|string|max:255',
                    'description.ar' => 'nullable|string|max:500',
                    'type'          => 'required|in:delivery,storage,handling',
                    'zone'          => 'nullable|string|max:255',
                    'min_weight'    => 'required|integer|min:0',
                    'max_weight'    => 'nullable|integer|min:0',
                    'max_length'    => 'nullable|integer|min:0',
                    'max_width'     => 'nullable|integer|min:0',
                    'max_height'    => 'nullable|integer|min:0',
                    'base_price'    => 'required|numeric|min:0',
                    'price_per_kg'  => 'required|numeric|min:0',
                    'extra_fee'     => 'nullable|numeric|min:0',
                    'oversized'     => 'boolean',
                    'fragile'       => 'boolean',
                    'perishable'    => 'boolean',
                    'express'       => 'boolean',
                    'same_day'      => 'boolean',
                    'status'        => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name.ar'        => 'required|string|max:255',
                    'description.ar' => 'nullable|string|max:500',
                    'type'          => 'required|in:delivery,storage,handling',
                    'zone'          => 'nullable|string|max:255',
                    'min_weight'    => 'required|integer|min:0',
                    'max_weight'    => 'nullable|integer|min:0',
                    'max_length'    => 'nullable|integer|min:0',
                    'max_width'     => 'nullable|integer|min:0',
                    'max_height'    => 'nullable|integer|min:0',
                    'base_price'    => 'required|numeric|min:0',
                    'price_per_kg'  => 'required|numeric|min:0',
                    'extra_fee'     => 'nullable|numeric|min:0',
                    'oversized'     => 'boolean',
                    'fragile'       => 'boolean',
                    'perishable'    => 'boolean',
                    'express'       => 'boolean',
                    'same_day'      => 'boolean',
                    'status'        => 'required',
                ];
            }
            default:
                return [];
        }
    }

    /**
     * Attribute names for validation messages
     */
    public function attributes(): array
    {
        return [
            'name'          => '( ' . __('pricing_rule.name') . ' )',
            'description'   => '( ' . __('pricing_rule.description') . ' )',
            'type'          => '( ' . __('pricing_rule.type') . ' )',
            'zone'          => '( ' . __('pricing_rule.zone') . ' )',
            'min_weight'    => '( ' . __('pricing_rule.min_weight') . ' )',
            'max_weight'    => '( ' . __('pricing_rule.max_weight') . ' )',
            'max_length'    => '( ' . __('pricing_rule.max_length') . ' )',
            'max_width'     => '( ' . __('pricing_rule.max_width') . ' )',
            'max_height'    => '( ' . __('pricing_rule.max_height') . ' )',
            'base_price'    => '( ' . __('pricing_rule.base_price') . ' )',
            'price_per_kg'  => '( ' . __('pricing_rule.price_per_kg') . ' )',
            'extra_fee'     => '( ' . __('pricing_rule.extra_fee') . ' )',
            'oversized'     => '( ' . __('pricing_rule.oversized') . ' )',
            'fragile'       => '( ' . __('pricing_rule.fragile') . ' )',
            'perishable'    => '( ' . __('pricing_rule.perishable') . ' )',
            'express'       => '( ' . __('pricing_rule.express') . ' )',
            'same_day'      => '( ' . __('pricing_rule.same_day') . ' )',
            'status'        => '( ' . __('general.status') . ' )',
        ];
    }
}
