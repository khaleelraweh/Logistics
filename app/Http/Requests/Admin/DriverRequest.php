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
                    'name.ar'                   => 'required|string|max:255',
                    'name.en'                   => 'required|string|max:255',

                    'phone'                     => 'nullable|string|max:20',
                    'username'                  => 'nullable|string|max:50|unique:drivers,username',
                    'email'                     => 'nullable|email|max:255|unique:drivers,email',
                    // 'password'                  => 'nullable|string|min:6|confirmed',
                    'password'                  => 'nullable|string|min:6',
                    'driver_image'              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',


                    'vehicle_type'              => 'nullable|string|max:100',
                    'vehicle_number'            => 'nullable|string|max:100',
                    'vehicle_model'             => 'nullable|string|max:100',
                    'vehicle_color'             => 'nullable|string|max:50',

                    'vehicle_capacity_weight'   => 'nullable|numeric|min:0',
                    'vehicle_capacity_volume'   => 'nullable|numeric|min:0',
                    'vehicle_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    'license_number'            => 'nullable|string|max:100',
                    'license_expiry_date'       => 'nullable|date',
                    'hired_date'                => 'nullable|date',
                    'license_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',
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
                    'name.ar'                   => 'required|string|max:255',
                    'name.en'                   => 'required|string|max:255',

                    'phone'                     => 'nullable|string|max:20',
                    'username'                  => 'nullable|string|max:50|unique:drivers,username,' . $this->route('driver'),
                    'email'                     => 'nullable|email|max:255|unique:drivers,email,' . $this->route('driver'),
                    // 'password'                  => 'nullable|string|min:6|confirmed',
                    'password'                  => 'nullable|string|min:6',
                    'driver_image'              =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    'vehicle_type'              => 'nullable|string|max:100',
                    'vehicle_number'            => 'nullable|string|max:100',
                    'vehicle_model'             => 'nullable|string|max:100',
                    'vehicle_color'             => 'nullable|string|max:50',

                    'vehicle_capacity_weight'   => 'nullable|numeric|min:0',
                    'vehicle_capacity_volume'   => 'nullable|numeric|min:0',
                    'vehicle_image'             =>  'nullable|mimes:jpg,jpeg,png,svg,webp|max:20000',

                    'license_number'            => 'nullable|string|max:100',
                    'license_expiry_date'       => 'nullable|date',
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
                'name.' . $key => __('driver.name') . ' (' . __('panel.' . $val['lang']) . ')',
            ];
        }

        return $attr;
    }
}
