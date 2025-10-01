<?php

namespace App\Helper;

class DeliveryHelper
{
    public function getStatusColor($status)
    {
        return match($status) {
            'pending'           => 'warning',
            'assigned_to_driver'=> 'primary',
            'driver_picked_up'  => 'info',
            'in_transit'        => 'info',
            'arrived_at_hub'    => 'secondary',
            'out_for_delivery'  => 'primary',
            'delivered'         => 'success',
            'delivery_failed'   => 'danger',
            'returned'          => 'secondary',
            'cancelled'         => 'danger',
            'in_warehouse'      => 'secondary',
            default              => 'secondary',
        };
    }
}
