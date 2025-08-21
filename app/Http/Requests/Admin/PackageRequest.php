<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
                    'merchant_id' => 'nullable|exists:merchants,id',

                    // Sender information
                    'sender_first_name' => 'required|string|max:255',
                    'sender_middle_name' => 'nullable|string|max:255',
                    'sender_last_name' => 'required|string|max:255',
                    'sender_email' => 'nullable|email|max:255',
                    'sender_phone' => 'required|string|max:20',
                    'sender_address' => 'required|string|max:500',
                    'sender_country' => 'required|string|max:100',
                    'sender_region' => 'nullable|string|max:100',
                    'sender_city' => 'required|string|max:100',
                    'sender_district' => 'nullable|string|max:100',
                    'sender_postal_code' => 'nullable|string|max:20',
                    'sender_location' => 'nullable|string|max:255',
                    'sender_others' => 'nullable|string|max:500',

                    // Receiver information
                    'receiver_first_name' => 'required|string|max:255',
                    'receiver_middle_name' => 'required|string|max:255', // Changed to required to match database schema
                    'receiver_last_name' => 'required|string|max:255',
                    'receiver_email' => 'nullable|email|max:255',
                    'receiver_phone' => 'required|string|max:20',
                    'receiver_address' => 'required|string|max:500',
                    'receiver_country' => 'required|string|max:100',
                    'receiver_region' => 'nullable|string|max:100',
                    'receiver_city' => 'required|string|max:100',
                    'receiver_district' => 'nullable|string|max:100',
                    'receiver_postal_code' => 'nullable|string|max:20',
                    'receiver_location' => 'nullable|string|max:255',
                    'receiver_others' => 'nullable|string|max:500',

                    // Package details
                    'package_type' => 'required|in:box,envelope,pallet,tube,bag',
                    'package_size' => 'required|in:small,medium,large,oversized',
                    'weight' => 'required|numeric|min:0',
                    'dimensions.length' => 'required|numeric|min:0',
                    'dimensions.width' => 'required|numeric|min:0',
                    'dimensions.height' => 'required|numeric|min:0',

                    // Delivery information
                    'delivery_speed' => 'required|in:standard,express,same_day,next_day',
                    'delivery_date' => 'required|date',
                    'status' => 'required|in:pending,assigned_to_driver,driver_picked_up,in_transit,arrived_at_hub,out_for_delivery,delivered,delivery_failed,returned,cancelled,in_warehouse',
                    'delivery_status_note' => 'nullable|string|max:1000',

                    // Payment information
                    'payment_responsibility' => 'required|in:merchant,recipient',
                    'delivery_fee' => 'required|numeric|min:0',
                    'insurance_fee' => 'required|numeric|min:0',
                    'service_fee' => 'required|numeric|min:0',
                    'paid_amount' => 'required|numeric|min:0',
                    'cod_amount' => 'nullable|numeric|min:0',

                    // Products validation
                    'products' => 'required|array|min:1',
                    'products.*.name' => 'required|string|max:255',
                    'products.*.weight' => 'required|numeric|min:0',
                    'products.*.quantity' => 'required|integer|min:1',
                    'products.*.price_per_unit' => 'required|numeric|min:0',
                    'products.*.total_price' => 'required|numeric|min:0',

                    // Attributes
                    'attributes.is_fragile' => 'nullable|boolean',
                    'attributes.is_returnable' => 'nullable|boolean',
                    'attributes.is_confidential' => 'nullable|boolean',
                    'attributes.is_express' => 'nullable|boolean',
                    'attributes.is_cod' => 'nullable|boolean',
                    'attributes.is_gift' => 'nullable|boolean',
                    'attributes.is_oversized' => 'nullable|boolean',
                    'attributes.is_hazardous_material' => 'nullable|boolean',
                    'attributes.is_temperature_controlled' => 'nullable|boolean',
                    'attributes.is_perishable' => 'nullable|boolean',
                    'attributes.is_signature_required' => 'nullable|boolean',
                    'attributes.is_inspection_required' => 'nullable|boolean',
                    'attributes.is_special_handling_required' => 'nullable|boolean',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'merchant_id' => 'nullable|exists:merchants,id',

                    // Sender information
                    'sender_first_name' => 'required|string|max:255',
                    'sender_middle_name' => 'nullable|string|max:255',
                    'sender_last_name' => 'required|string|max:255',
                    'sender_email' => 'nullable|email|max:255',
                    'sender_phone' => 'required|string|max:20',
                    'sender_address' => 'required|string|max:500',
                    'sender_country' => 'required|string|max:100',
                    'sender_region' => 'nullable|string|max:100',
                    'sender_city' => 'required|string|max:100',
                    'sender_district' => 'nullable|string|max:100',
                    'sender_postal_code' => 'nullable|string|max:20',
                    'sender_location' => 'nullable|string|max:255',
                    'sender_others' => 'nullable|string|max:500',

                    // Receiver information
                    'receiver_first_name' => 'required|string|max:255',
                    'receiver_middle_name' => 'required|string|max:255', // Changed to required to match database schema
                    'receiver_last_name' => 'required|string|max:255',
                    'receiver_email' => 'nullable|email|max:255',
                    'receiver_phone' => 'required|string|max:20',
                    'receiver_address' => 'required|string|max:500',
                    'receiver_country' => 'required|string|max:100',
                    'receiver_region' => 'nullable|string|max:100',
                    'receiver_city' => 'required|string|max:100',
                    'receiver_district' => 'nullable|string|max:100',
                    'receiver_postal_code' => 'nullable|string|max:20',
                    'receiver_location' => 'nullable|string|max:255',
                    'receiver_others' => 'nullable|string|max:500',

                    // Package details
                    'package_type' => 'required|in:box,envelope,pallet,tube,bag',
                    'package_size' => 'required|in:small,medium,large,oversized',
                    'weight' => 'required|numeric|min:0',
                    'dimensions.length' => 'required|numeric|min:0',
                    'dimensions.width' => 'required|numeric|min:0',
                    'dimensions.height' => 'required|numeric|min:0',

                    // Delivery information
                    'delivery_speed' => 'required|in:standard,express,same_day,next_day',
                    'delivery_date' => 'required|date',
                    'status' => 'required|in:pending,assigned_to_driver,driver_picked_up,in_transit,arrived_at_hub,out_for_delivery,delivered,delivery_failed,returned,cancelled,in_warehouse',
                    'delivery_status_note' => 'nullable|string|max:1000',

                    // Payment information
                    'payment_responsibility' => 'required|in:merchant,recipient',
                    'delivery_fee' => 'required|numeric|min:0',
                    'insurance_fee' => 'required|numeric|min:0',
                    'service_fee' => 'required|numeric|min:0',
                    'paid_amount' => 'required|numeric|min:0',
                    'cod_amount' => 'nullable|numeric|min:0',

                    // Products validation
                    'products' => 'sometimes|array|min:1',
                    'products.*.name' => 'required_with:products|string|max:255',
                    'products.*.weight' => 'required_with:products|numeric|min:0',
                    'products.*.quantity' => 'required_with:products|integer|min:1',
                    'products.*.price_per_unit' => 'required_with:products|numeric|min:0',
                    'products.*.total_price' => 'required_with:products|numeric|min:0',

                    // Attributes
                    'attributes.is_fragile' => 'nullable|boolean',
                    'attributes.is_returnable' => 'nullable|boolean',
                    'attributes.is_confidential' => 'nullable|boolean',
                    'attributes.is_express' => 'nullable|boolean',
                    'attributes.is_cod' => 'nullable|boolean',
                    'attributes.is_gift' => 'nullable|boolean',
                    'attributes.is_oversized' => 'nullable|boolean',
                    'attributes.is_hazardous_material' => 'nullable|boolean',
                    'attributes.is_temperature_controlled' => 'nullable|boolean',
                    'attributes.is_perishable' => 'nullable|boolean',
                    'attributes.is_signature_required' => 'nullable|boolean',
                    'attributes.is_inspection_required' => 'nullable|boolean',
                    'attributes.is_special_handling_required' => 'nullable|boolean',
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
            'merchant_id' => __('merchant.merchant'),
            'sender_first_name' => __('package.sender_first_name'),
            'sender_middle_name' => __('package.sender_middle_name'),
            'sender_last_name' => __('package.sender_last_name'),
            'sender_email' => __('package.sender_email'),
            'sender_phone' => __('package.sender_phone'),
            'sender_address' => __('package.sender_address'),
            'sender_country' => __('package.sender_country'),
            'sender_region' => __('package.sender_region'),
            'sender_city' => __('package.sender_city'),
            'sender_district' => __('package.sender_district'),
            'sender_postal_code' => __('package.sender_postal_code'),
            'sender_location' => __('package.sender_location'),
            'sender_others' => __('package.sender_others'),
            'receiver_first_name' => __('package.receiver_first_name'),
            'receiver_middle_name' => __('package.receiver_middle_name'),
            'receiver_last_name' => __('package.receiver_last_name'),
            'receiver_email' => __('package.receiver_email'),
            'receiver_phone' => __('package.receiver_phone'),
            'receiver_address' => __('package.receiver_address'),
            'receiver_country' => __('package.receiver_country'),
            'receiver_region' => __('package.receiver_region'),
            'receiver_city' => __('package.receiver_city'),
            'receiver_district' => __('package.receiver_district'),
            'receiver_postal_code' => __('package.receiver_postal_code'),
            'receiver_location' => __('package.receiver_location'),
            'receiver_others' => __('package.receiver_others'),
            'package_type' => __('package.package_type'),
            'package_size' => __('package.package_size'),
            'weight' => __('package.weight'),
            'dimensions.length' => __('package.dimensions.length'),
            'dimensions.width' => __('package.dimensions.width'),
            'dimensions.height' => __('package.dimensions.height'),
            'delivery_speed' => __('package.delivery_speed'),
            'delivery_date' => __('package.delivery_date'),
            'status' => __('package.status'),
            'delivery_status_note' => __('package.delivery_status_note'),
            'payment_responsibility' => __('package.payment_responsibility'),
            'delivery_fee' => __('package.delivery_fee'),
            'insurance_fee' => __('package.insurance_fee'),
            'service_fee' => __('package.service_fee'),
            'paid_amount' => __('package.paid_amount'),
            'cod_amount' => __('package.cod_amount'),
            'products' => __('product.products'),
            'products.*.name' => __('product.name'),
            'products.*.weight' => __('product.weight'),
            'products.*.quantity' => __('product.quantity'),
            'products.*.price_per_unit' => __('product.price_per_unit'),
            'products.*.total_price' => __('product.total_price'),
            'attributes.is_fragile' => __('package.is_fragile'),
            'attributes.is_returnable' => __('package.is_returnable'),
            'attributes.is_confidential' => __('package.is_confidential'),
            'attributes.is_express' => __('package.is_express'),
            'attributes.is_cod' => __('package.is_cod'),
            'attributes.is_gift' => __('package.is_gift'),
            'attributes.is_oversized' => __('package.is_oversized'),
            'attributes.is_hazardous_material' => __('package.is_hazardous_material'),
            'attributes.is_temperature_controlled' => __('package.is_temperature_controlled'),
            'attributes.is_perishable' => __('package.is_perishable'),
            'attributes.is_signature_required' => __('package.is_signature_required'),
            'attributes.is_inspection_required' => __('package.is_inspection_required'),
            'attributes.is_special_handling_required' => __('package.is_special_handling_required'),
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'required' => ':attribute مطلوب.',
            'string' => ':attribute يجب أن يكون نصًا.',
            'max' => ':attribute يجب ألا يتجاوز :max حروف.',
            'email' => ':attribute يجب أن يكون بريدًا إلكترونيًا صالحًا.',
            'numeric' => ':attribute يجب أن يكون رقمًا.',
            'min' => ':attribute يجب ألا يقل عن :min.',
            'in' => ':attribute يجب أن يكون واحدًا من: :values.',
            'exists' => ':attribute غير موجود في النظام.',
            'array' => ':attribute يجب أن يكون قائمة.',
            'products.min' => 'يجب إضافة منتج واحد على الأقل.',
            'required_with' => ':attribute مطلوب عند إضافة منتجات.',
        ];
    }
}
