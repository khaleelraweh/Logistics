<?php

namespace App\Http\Requests\Driver;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
                    'driver_id'      => 'required|exists:drivers,id',
                    'package_id'     => 'required|exists:packages,id',
                    'assigned_at'    => 'nullable|date',
                    'status'        => 'required|in:pending,assigned_to_driver,driver_picked_up,in_transit,arrived_at_hub,out_for_delivery,delivered,delivery_failed,returned,cancelled,in_warehouse',
                    'note'           => 'nullable|string|max:255',
                    'created_by'     => 'nullable|string|max:255',
                    'updated_by'     => 'nullable|string|max:255',
                    'deleted_by'     => 'nullable|string|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'driver_id'      => 'required|exists:drivers,id',
                    'package_id'     => 'required|exists:packages,id',
                    'assigned_at'    => 'nullable|date',
                    'status' => 'required|in:pending,assigned_to_driver,driver_picked_up,in_transit,arrived_at_hub,out_for_delivery,delivered,delivery_failed,returned,cancelled,in_warehouse',
                    'note'           => 'nullable|string|max:255',
                    'created_by'     => 'nullable|string|max:255',
                    'updated_by'     => 'nullable|string|max:255',
                    'deleted_by'     => 'nullable|string|max:255',
                ];
            }
            default:
                return [];
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'driver_id'    => '( ' . __('delivery.driver') . ' )',
            'package_id'   => '( ' . __('delivery.package') . ' )',
            'assigned_at'  => '( ' . __('delivery.assigned_at') . ' )',
            'status'       => '( ' . __('delivery.status') . ' )',
            'note'         => '( ' . __('general.note') . ' )',
        ];
    }
}
