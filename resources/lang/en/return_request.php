<?php
return [

    // General titles
    'manage_return_requests'        => 'Manage Return Requests',
    'view_return_requests'          => 'View Return Requests',
    'add_new_return_request'        => 'Add New Return Request',
    'add_return_request'            => 'Add Return Request',
    'edit_return_request'           => 'Edit Return Request',
    'return_request_data'           => 'Return Request Data',
    'return_request_description'    => 'Here you can manage and track return requests.',
    'return_request_info'           => 'Return Request Information',
    'view_return_request'           => 'View Return Request Details',
    'additional_info'                => 'Additional Information',
    'edit_return_request_description' => 'Here you can edit the return request details.',
    'update_status_reason'      => 'Update Status and Reason',
    'return_request_summary' => 'Return Request Summary',
    'current_status' => 'Current Status',
    'status_help_text' => 'Select the new status for this return request. Only valid status transitions are allowed.',
    'timeline' => 'Timeline',
    'reason_help_text' => 'Provide a reason for the status change, if applicable.',
    'quick_actions' => 'Quick Actions',
    'reason_placeholder' => 'Enter the reason for return (if any)',
    'package_details' => 'Package Details',
    'customer_info' => 'Customer Information',
    'total_requests' => 'Total Return Requests',
    'pending'       =>  'Pending',
    'in_progress'   =>  'In Progress',
    'completed'     =>  'Completed',

    // Column names
    'id'                      => 'ID',
    'package'                 => 'Package',
    'merchant'                => 'Merchant',
    'driver'                  => 'Driver',
    'status'                  => 'Status',
    'requested_at'            => 'Requested At',
    'received_at'             => 'Received At',
    'created_at'              => 'Created At',
    'updated_at'              => 'Updated At',
    'note'                    => 'Note',
    'reason'                  => 'Return Reason',
    'target_address'          => 'Target Address',
    'return_type'             => 'Return Type',

    // Return types
    'type_to_warehouse'       => 'To Warehouse',
    'type_to_merchant'        => 'To Merchant',
    'type_to_both'            => 'To Warehouse / Merchant',

    // Return items
    'return_items'            => 'Return Items',
    'return_item'             => 'Return Item',
    'product'                 => 'Product',
    'shipped_qty'             => 'Shipped Quantity',
    'return_qty'              => 'Returned Quantity',
    'quantity'                => 'Quantity',
    'type'                    => 'Type',
    'item_id'                 => 'Item ID',

    // Statuses
    'status_requested'        => 'Requested',
    'status_assigned_to_driver' => 'Assigned to Driver',
    'status_picked_up'        => 'Picked Up by Driver',
    'status_in_transit'      => 'In Transit',
    'status_received'        => 'Received',
    'status_rejected'        => 'Rejected',
    'status_partially_received' => 'Partially Received',
    'status_cancelled'       => 'Cancelled',
    'unknown'                => 'Unknown',

    // Actions
    'show'                    => 'Show',
    'edit'                    => 'Edit',
    'delete'                  => 'Delete',
    'save_return_request'     => 'Save Return Request Data',
    'update_return_request'   => 'Update Return Request Data',
    'back'                    => 'Back',

    // Messages
    'no_return_requests_found'  => 'No return requests found currently.',
    'return_request_created'    => 'Return request created successfully.',
    'return_request_updated'    => 'Return request updated successfully.',
    'return_request_deleted'    => 'Return request deleted successfully.',
    'return_request_not_found'  => 'Return request not found.',
    'something_went_wrong'     => 'Something went wrong, please try again.',
    'confirm_delete'           => 'Are you sure you want to delete this return request?',
    'yes_delete'               => 'Yes, Delete',
    'cancel'                   => 'Cancel',

    // Selections
    'select_driver'            => 'Select Driver',
    'select_package'           => 'Select Package',

    // Assign
    'assign_to_driver'        => 'Assign to Driver',
    'assigned_at'             => 'Assigned At',
    'assign'                  => 'Assign',
    'sender'                =>  'Sender',
    'receiver'              =>  'Receiver',
    'return_request_information' => 'Return Request Information',

    'delivery_information'  =>  'Delivery Information',
    'reason_message'  => 'Enter the reason for return (if any)',
    'all_return_items'  => 'All Return Items',

    //show blade
    'total_items'  => 'Total Items',
    'stock_items'  => 'Stock Items',
    'custom_items'  => 'Custom Items',
    'total_quantity'  => 'Total Quantity',
    'status_timeline' => 'Status Timeline',
    'progress_overview' => 'Progress Overview',


];
