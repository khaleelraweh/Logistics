<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExternalShipmentRequest extends FormRequest
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
                    'shipping_partner_id'      => 'required|exists:shipping_partners,id',
                    'package_id'               => 'required|exists:packages,id',
                    'external_tracking_number' => 'required|string|max:255|unique:external_shipments,external_tracking_number',
                    'status'                   => 'nullable|string|in:pending,in_transit,delivered,cancelled',
                    'delivery_date'            => 'nullable|date',
                    'synced_at'                => 'nullable|date',
                    'delivered_at'             => 'nullable|date',
                    'status_visible'           => 'nullable|boolean',
                    'published_on'             => 'nullable|date',
                    'created_by'               => 'nullable|string|max:255',
                    'updated_by'               => 'nullable|string|max:255',
                    'deleted_by'               => 'nullable|string|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'shipping_partner_id'      => 'required|exists:shipping_partners,id',
                    'package_id'               => 'required|exists:packages,id',
                    'external_tracking_number' => 'required|string|max:255|unique:external_shipments,external_tracking_number,' . $this->route('external_shipment'),
                    'status'                   => 'nullable|string|in:pending,in_transit,delivered,cancelled',
                    'delivery_date'            => 'nullable|date',
                    'synced_at'                => 'nullable|date',
                    'delivered_at'             => 'nullable|date',
                    'status_visible'           => 'nullable|boolean',
                    'published_on'             => 'nullable|date',
                    'created_by'               => 'nullable|string|max:255',
                    'updated_by'               => 'nullable|string|max:255',
                    'deleted_by'               => 'nullable|string|max:255',
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
            'shipping_partner_id'      => '( ' . __('external_shipment.shipping_partner') . ' )',
            'package_id'               => '( ' . __('external_shipment.package') . ' )',
            'external_tracking_number' => '( ' . __('external_shipment.external_tracking_number') . ' )',
            'status'                   => '( ' . __('external_shipment.status') . ' )',
            'delivery_date'            => '( ' . __('external_shipment.delivery_date') . ' )',
            'synced_at'                => '( ' . __('external_shipment.synced_at') . ' )',
            'delivered_at'             => '( ' . __('external_shipment.delivered_at') . ' )',
            'status_visible'           => '( ' . __('external_shipment.status_visible') . ' )',
            'published_on'             => '( ' . __('external_shipment.published_on') . ' )',
            'note'                     => '( ' . __('general.note') . ' )',
        ];
    }
}
