<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PickupRequest extends Model
{
    use HasFactory , SearchableTrait;

    protected $guarded = [];

    const STATUS_PENDING   = 'pending';
    const STATUS_ACCEPTED  = 'accepted';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ACCEPTED,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ];
    }


      protected $searchable = [
        'columns' => [
            // أعمدة جدول pickup_requests
            'pickup_requests.id'           => 10,
            'pickup_requests.status'       => 10,
            'pickup_requests.note'         => 10,
            'pickup_requests.country'      => 5,
            'pickup_requests.region'       => 5,
            'pickup_requests.city'         => 5,
            'pickup_requests.district'     => 5,
            'pickup_requests.postal_code'  => 5,
            'pickup_requests.scheduled_at' => 5,
            'pickup_requests.accepted_at'  => 5,
            'pickup_requests.completed_at' => 5,

            // أعمدة جدول merchants المرتبط
            'merchants.name'        => 10,
            'merchants.phone'       => 10,
            'merchants.email'       => 10,
            'merchants.contact_person' => 5,

            // أعمدة جدول drivers المرتبط
            'drivers.first_name'    => 10,
            'drivers.middle_name'   => 5,
            'drivers.last_name'     => 10,
            'drivers.phone'         => 10,
            'drivers.vehicle_number'=> 5,
            'drivers.vehicle_type'  => 5,
        ],
        'joins' => [
            'merchants' => ['merchants.id', 'pickup_requests.merchant_id'],
            'drivers'   => ['drivers.id', 'pickup_requests.driver_id'],
        ],
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'accepted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

     public function updateStatus(string $status): bool
    {
        if (!in_array($status, self::getStatuses())) {
            return false; // الحالة غير مسموحة
        }

        $this->status = $status;

        if ($status === self::STATUS_ACCEPTED) {
            $this->accepted_at = now();
        }

        if ($status === self::STATUS_COMPLETED) {
            $this->completed_at = now();
        }

        return $this->save();
    }

    public function availableStatuses()
    {
        $currentStatus = $this->status ?? 'pending'; // افتراضياً pending

        switch ($currentStatus) {
            case 'pending': return ['accepted','cancelled'];
            case 'accepted': return ['completed','cancelled'];

            default: return [];
        }
    }

    public function availableStatusesForDriver()
    {
        if (auth()->user()->hasRole('driver')) {
            switch ($this->status) {
                case 'pending': return ['accepted','cancelled'];
                case 'accepted': return ['completed','cancelled'];
                default: return [];
            }
        }

        return $this->availableStatuses(); // باقي المستخدمين
    }

    // في model PickupRequest
    public function hasValidCoordinates()
    {
        return !empty($this->latitude) && !empty($this->longitude) &&
            is_numeric($this->latitude) && is_numeric($this->longitude);
    }

    public function getCoordinatesAttribute()
    {
        if ($this->hasValidCoordinates()) {
            return [
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude
            ];
        }

        return null;
    }
}
