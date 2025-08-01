<?php

namespace App\Console\Commands;

use App\Models\WarehouseRental;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireWarehouseRentals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rentals:expire-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark expired warehouse rentals based on rental_end date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredCount = WarehouseRental::where('status', 1)
            ->whereDate('rental_end', '<', Carbon::today())
            ->update(['status' => 2]);

        $this->info("Updated {$expiredCount} rentals to expired.");

    }
}
