<?php

return [

    // General titles
    'manage_deliveries'        => 'Manage Deliveries',
    'view_deliveries'          => 'View Deliveries',
    'add_new_delivery'         => 'Add New Delivery',
    'add_delivery'             => 'Add Delivery',
    'edit_delivery'            => 'Edit Delivery',
    'delivery_data'            => 'Delivery Data',
    'delivery_description'     => 'Here you can manage and track delivery operations.',
    'delivery_info'            => 'Delivery Information',

    'update_status'          => 'Update Status',
    'update_delivery_status' => 'Update Delivery Status',
    'add_delivery_note_placeholder' => 'Add a note about the delivery status...',
    'special_instructions' => 'Special Instructions',
    'view_on_map' => 'View on Map',
    'recipient'       => 'Recipient',
    'address'       => 'Address',
    'cod_amount'       => 'COD Amount',

    'delivery_details'         => 'Delivery Details',
    'driver_info'              => 'Driver Information',
    'package_info'             => 'Package Information',
    'timeline_title'           => 'Delivery Timeline',
    'receiver'                  => 'Receiver',

    'delivery_updated_status' => 'Delivery updated: status changed to :status, driver: :driver',
    'delivery_assigned_status' => 'Delivery assigned to driver: :driver',


    // Column names
    'package'                  => 'Package',
    'driver'                   => 'Driver',
    'status'                   => 'Status',
    'assigned_at'              => 'Assigned At',
    'delivered_at'             => 'Delivered At',
    'created_at'               => 'Created At',
    'note'                     => 'Note',
    'actions'                  => 'Actions',


    // delivery statuses
    'status_pending'            => 'Pending',
    'status_assigned_to_driver' => 'Assigned to Driver',
    'status_driver_picked_up'   => 'Driver Picked Up',
    'status_in_transit'         => 'In Transit',
    'status_arrived_at_hub'     => 'Arrived at Hub',
    'status_out_for_delivery'   => 'Out for Delivery',
    'status_delivered'          => 'Delivered',
    'status_delivery_failed'    => 'Delivery Failed',
    'status_returned'           => 'Returned',
    'status_cancelled'          => 'Cancelled',
    'status_in_warehouse'       => 'In Warehouse',

    // Operations
    'show'                     => 'Show',
    'edit'                     => 'Edit',
    'delete'                   => 'Delete',
    'save_delivery'            => 'Save Delivery Data',
    'update_delivery'          => 'Update Delivery Data',

    // Messages
    'no_deliveries_found'      => 'No deliveries found.',
    'delivery_created'         => 'Delivery created successfully.',
    'delivery_updated'         => 'Delivery updated successfully.',
    'delivery_deleted'         => 'Delivery deleted successfully.',
    'something_went_wrong'     => 'Something went wrong, please try again.',
    'confirm_delete'           => 'Are you sure you want to delete this delivery?',
    'yes_delete'               => 'Yes, delete',
    'cancel'                   => 'Cancel',

    // Selections
    'select_driver'            => 'Select Driver',
    'select_package'           => 'Select Package',

    // Assignment
    'assign_to_driver'         => 'Assign to Driver',
    'assigned_at'              => 'Assigned At',
    'note'                     => 'Notes',
    'assign'                   => 'Assign',
    'view_delivery'            => 'View Delivery',

    // index blade
        'status_updated_successfully' => 'Delivery status updated successfully',
        'unauthorized_status_update' => 'You are not authorized to update this delivery status',

        // Log texts
        'log_driver_picked_up' => 'Driver :driver picked up the package at :time',
        'log_in_transit' => 'Package in transit with driver :driver',
        'log_arrived_at_hub' => 'Package arrived at hub',
        'log_out_for_delivery' => 'Package out for delivery',
        'log_delivered' => 'Package delivered at :time by driver :driver',
        'log_delivery_failed' => 'Delivery attempt failed (Attempt :attempt)',
        'log_returned' => 'Package returned',
        'log_cancelled' => 'Delivery cancelled',
        'log_status_changed' => 'Status changed from :from to :to',

        // Status texts
        'mark_as' => 'Mark as',

        // Notification texts
        'notification_delivered' => 'Your package has been delivered successfully',
        'notification_failed' => 'Your package delivery failed',

            // Statistics texts
    'total_deliveries' => 'Total Deliveries',
    'pending' => 'Pending',
    'assigned' => 'Assigned',
    'in_transit' => 'In Transit',
    'delivered' => 'Delivered',
    'failed_cancelled' => 'Failed/Cancelled',

    // Detailed statistics
    'detailed_statistics' => 'Detailed Statistics',
    'picked_up' => 'Picked Up',
    'at_hub' => 'At Hub',
    'out_for_delivery' => 'Out for Delivery',
    'successful' => 'Successful',
    'failed' => 'Failed',
    'returned' => 'Returned',

    // Delivery statuses
    'status_pending' => 'Pending',
    'status_assigned_to_driver' => 'Assigned to Driver',
    'status_driver_picked_up' => 'Picked Up',
    'status_in_transit' => 'In Transit',
    'status_arrived_at_hub' => 'Arrived at Hub',
    'status_out_for_delivery' => 'Out for Delivery',
    'status_delivered' => 'Delivered',
    'status_delivery_failed' => 'Delivery Failed',
    'status_returned' => 'Returned',
    'status_cancelled' => 'Cancelled',
    'status_in_warehouse' => 'In Warehouse',



];
