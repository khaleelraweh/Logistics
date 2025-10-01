<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class ReturnRequestRequest extends FormRequest
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
                    'package_id'     => 'required|exists:packages,id',
                    'driver_id'      => 'required|exists:drivers,id',
                    'return_type'    => 'nullable|string|in:to_warehouse,to_merchant,to_both',
                    'target_address'    => 'nullable|string|max:255',
                    'requested_at'      => 'nullable|date',
                    'status'            => 'nullable|string|in:requested,assigned_to_driver,picked_up,in_transit,received,rejected',
                    'received_at'       => 'nullable|date',
                    'reason'            => 'nullable|string|max:255',

                    'created_by'     => 'nullable|string|max:255',
                    'updated_by'     => 'nullable|string|max:255',
                    'deleted_by'     => 'nullable|string|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'package_id'     => 'required|exists:packages,id',
                    'driver_id'      => 'required|exists:drivers,id',
                    'return_type'    => 'nullable|string|in:to_warehouse,to_merchant,to_both',
                    'target_address'    => 'nullable|string|max:255',
                    'requested_at'      => 'nullable|date',
                    'status'            => 'nullable|string|in:requested,assigned_to_driver,picked_up,in_transit,received,rejected',
                    'received_at'       => 'nullable|date',
                    'reason'            => 'nullable|string|max:255',

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
            'driver_id'    => '( ' . __('return_request.driver') . ' )',
            'package_id'   => '( ' . __('return_request.package') . ' )',
            'return_type'  => '( ' . __('return_request.return_type') . ' )',

            'target_address'    =>  '(' . __('target_address') . ')' ,
            'requested_at'  =>  '(' . __('requested_at') . ')' ,
            'status'    =>  '(' . __('status') . ')' ,
            'received_at'   =>  '(' . __('received_at') . ')' ,
            'reason'    =>  '(' . __('reason') . ')' ,

        ];
    }
}
