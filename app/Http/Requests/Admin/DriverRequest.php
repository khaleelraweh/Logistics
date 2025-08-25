<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // عدل هذا حسب صلاحياتك
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
                    'first_name.*'                   => 'required|string|max:255',
                    'middle_name.*'                  => 'required|string|max:255',
                    'last_name.*'                    => 'required|string|max:255',

                    'phone'                     => 'required|string|max:20',
                    'username'                  => 'required|string|max:50|unique:drivers,username',
                    'email'                     => 'required|email|max:255|unique:drivers,email',
                    // 'password'                  => 'nullable|string|min:6|confirmed',
                    'password'                  => 'nullable|string|min:6',
                    'driver_image'              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    // Location details
                    'country'                   => 'nullable|string|max:100',
                    'region'                    => 'nullable|string|max:100',
                    'city'                      => 'nullable|string|max:100',
                    'district'                  => 'nullable|string|max:100',
                    'latitude'                  => 'nullable|numeric|between:-90,90',
                    'longitude'                 => 'nullable|numeric|between:-180,180',


                    'vehicle_type'              => 'required|string|max:100',
                    'vehicle_number'            => 'required|string|max:100',
                    'vehicle_model'             => 'required|string|max:100',
                    'vehicle_color'             => 'nullable|string|max:50',

                    'vehicle_capacity_weight'   => 'nullable|numeric|min:0',
                    'vehicle_capacity_volume'   => 'nullable|numeric|min:0',
                    'vehicle_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    'license_number'            => 'required|string|max:100',
                    'license_expiry_date'       => 'required|date',
                    'hired_date'                => 'nullable|date',
                    'license_image'             =>  'required|mimes:jpg,jpeg,png,svg,webp|max:20000',
                    'id_card_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    // 'supervisor_id'             => 'nullable|integer|exists:users,id', // إذا كان المشرف من جدول users
                    'supervisor_id'             => 'nullable', // إذا كان المشرف من جدول users

                    'availability_status'       => 'required|in:available,busy,offline',
                    'status'                   => 'required|in:active,inactive,suspended,terminated',
                    'reason'                   => 'nullable|string|max:500',

                    'created_by'               => 'nullable|string|max:255',
                    'updated_by'               => 'nullable|string|max:255',
                    'deleted_by'               => 'nullable|string|max:255',
                ];
            }

            case 'PUT':
            case 'PATCH': {
                return [
                    'first_name.*'                   => 'required|string|max:255',
                    'middle_name.*'                  => 'required|string|max:255',
                    'last_name.*'                    => 'required|string|max:255',

                    'phone'                     => 'required|string|max:20',
                    'username'                  => 'required|string|max:50|unique:drivers,username,' . $this->route('driver'),
                    'email'                     => 'required|email|max:255|unique:drivers,email,' . $this->route('driver'),
                    // 'password'                  => 'nullable|string|min:6|confirmed',
                    'password'                  => 'nullable|string|min:6',
                    'driver_image'              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    // Location details
                    'country'                   => 'nullable|string|max:100',
                    'region'                    => 'nullable|string|max:100',
                    'city'                      => 'nullable|string|max:100',
                    'district'                  => 'nullable|string|max:100',
                    'latitude'                  => 'nullable|numeric|between:-90,90',
                    'longitude'                 => 'nullable|numeric|between:-180,180',

                    'vehicle_type'              => 'required|string|max:100',
                    'vehicle_number'            => 'required|string|max:100',
                    'vehicle_model'             => 'required|string|max:100',
                    'vehicle_color'             => 'nullable|string|max:50',

                    'vehicle_capacity_weight'   => 'nullable|numeric|min:0',
                    'vehicle_capacity_volume'   => 'nullable|numeric|min:0',
                    'vehicle_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    'license_number'            => 'required|string|max:100',
                    'license_expiry_date'       => 'required|date',
                    'hired_date'                => 'nullable|date',
                    'license_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',
                    'id_card_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',


                    // 'supervisor_id'             => 'nullable|integer|exists:users,id',
                    'supervisor_id'             => 'nullable',

                    'availability_status'       => 'required|in:available,busy,offline',
                    'status'                   => 'required|in:active,inactive,suspended,terminated',
                    'reason'                   => 'nullable|string|max:500',

                    'created_by'               => 'nullable|string|max:255',
                    'updated_by'               => 'nullable|string|max:255',
                    'deleted_by'               => 'nullable|string|max:255',
                ];
            }

            default:
                return [];
        }
    }

    public function attributes(): array
    {
        $attr = [
            'phone'                     => __('driver.phone'),
            'username'                  => __('driver.username'),
            'email'                     => __('driver.email'),
            'password'                  => __('driver.password'),
            'driver_image'              => __('driver.driver_image'),

            'vehicle_type'              => __('driver.vehicle_type'),
            'vehicle_number'            => __('driver.vehicle_number'),
            'vehicle_model'             => __('driver.vehicle_model'),
            'vehicle_color'             => __('driver.vehicle_color'),

            'vehicle_capacity_weight'   => __('driver.vehicle_capacity_weight'),
            'vehicle_capacity_volume'   => __('driver.vehicle_capacity_volume'),
            'vehicle_image'             => __('driver.vehicle_image'),

            'license_number'            => __('driver.license_number'),
            'license_expiry_date'       => __('driver.license_expiry_date'),
            'hired_date'                => __('driver.hired_date'),
            'license_image'             => __('driver.license_image'),
            'id_card_image'             => __('driver.id_card_image'),

            'supervisor_id'             => __('driver.supervisor_id'),

            'availability_status'       => __('driver.availability_status'),
            'status'                    => __('driver.status'),
            'reason'                    => __('driver.reason'),
        ];

        foreach (config('locales.languages') as $key => $val) {
            $attr += [
                'first_name.' . $key => __('driver.first_name') . ' (' . __('panel.' . $val['lang']) . ')',
                'first_middle_name.' . $key => __('driver.first_middle_name') . ' (' . __('panel.' . $val['lang']) . ')',
                'first_last_name.' . $key => __('driver.first_last_name') . ' (' . __('panel.' . $val['lang']) . ')',
            ];
        }

        return $attr;
    }
}
