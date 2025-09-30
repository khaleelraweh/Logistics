<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'requested_at' => 'datetime',
        'received_at' => 'datetime',
        'published_on' => 'datetime',
    ];

    // ---------------------- علاقات ----------------------
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function merchant()
    {
        return $this->hasOneThrough(
            Merchant::class,
            Package::class,
            'merchant_id', // foreign key في Packages يشير إلى Merchant
            'id',          // foreign key في Merchants عادة id
            'package_id',  // local key في ReturnRequests
            'id'           // local key في Packages
        );
    }

    public function targetShelf()
    {
        return $this->belongsTo(Shelf::class, 'target_shelf_id');
    }

    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class);
    }

    // ---------------------- الثوابت ----------------------
    const STATUS_REQUESTED   = 'requested';
    const STATUS_ASSIGNED_TO_DRIVER  = 'assigned_to_driver';
    const STATUS_PICKED_UP = 'picked_up';
    const STATUS_IN_TRANSIT = 'in_transit';
    const STATUS_RECEIVED = 'received';
    const STATUS_PARTIALLY_RECEIVED = 'partially_received';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELLED = 'cancelled';

    protected static array $allowedTransitions = [
        'requested' => [
            'admin' => ['assigned_to_driver', 'cancelled'],
            'merchant' => ['cancelled'],
            'driver' => [],
        ],
        'assigned_to_driver' => [
            'admin' => ['picked_up', 'cancelled'],
            'merchant' => [],
            'driver' => ['picked_up', 'cancelled'],
        ],
        'picked_up' => [
            'admin' => ['in_transit', 'cancelled'],
            'merchant' => [],
            'driver' => ['in_transit', 'cancelled'],
        ],
        'in_transit' => [
            'admin' => ['received', 'rejected', 'partially_received'],
            'merchant' => [],
            'driver' => ['received', 'partially_received'],
        ],
        'received' => ['admin'=>[],'merchant'=>[],'driver'=>[]],
        'partially_received' => ['admin'=>[],'merchant'=>[],'driver'=>[]],
        'rejected' => ['admin'=>[],'merchant'=>[],'driver'=>[]],
        'cancelled' => ['admin'=>[],'merchant'=>[],'driver'=>[]],
    ];

    // ---------------------- دوال الحالة ----------------------
    public static function getStatuses(): array
    {
        return [
            self::STATUS_REQUESTED,
            self::STATUS_ASSIGNED_TO_DRIVER,
            self::STATUS_PICKED_UP,
            self::STATUS_IN_TRANSIT,
            self::STATUS_RECEIVED,
            self::STATUS_PARTIALLY_RECEIVED,
            self::STATUS_REJECTED,
            self::STATUS_CANCELLED,
        ];
    }

    public function statusLabel()
    {
        return match ($this->status) {
            self::STATUS_REQUESTED => __('return_request.status_requested'),
            self::STATUS_ASSIGNED_TO_DRIVER => __('return_request.status_assigned_to_driver'),
            self::STATUS_PICKED_UP => __('return_request.status_picked_up'),
            self::STATUS_IN_TRANSIT => __('return_request.status_in_transit'),
            self::STATUS_RECEIVED => __('return_request.status_received'),
            self::STATUS_REJECTED => __('return_request.status_rejected'),
            self::STATUS_PARTIALLY_RECEIVED => __('return_request.status_partially_received'),
            self::STATUS_CANCELLED => __('return_request.status_status_cancelled'),
            default => __('return_request.unknown'),
        };
    }

    public function updateStatus(string $status): bool
    {
        if (!in_array($status, self::getStatuses())) return false;

        $this->status = $status;

        if (in_array($status, [self::STATUS_REQUESTED])) {
            $this->requested_at = now();
        }

        if (in_array($status, [self::STATUS_RECEIVED, self::STATUS_PARTIALLY_RECEIVED])) {
            $this->received_at = now();
        }

        $this->updated_by = auth()->user()->full_name ?? 'system';

        return $this->save();
    }

    public function currentUserRole(): ?string
    {
        $user = auth()->user();
        if (!$user) return null;

        $role = $user->roles()->first();
        return $role ? $role->name : null;
    }

    public function availableStatusesByRole(): array
    {
        $role = $this->currentUserRole();
        if (!$role) return [];

        $available = self::$allowedTransitions[$this->status][$role] ?? [];

        // لإبقاء الحالة الحالية موجودة دائمًا في القائمة
        if (!in_array($this->status, $available)) {
            array_unshift($available, $this->status);
        }

        return $available;
    }
}
