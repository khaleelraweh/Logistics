<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Shelf;
use App\Models\WarehouseRental;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WarehouseRentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a merchant (or create one if needed)
        $merchant = Merchant::first();

        // Get 3 shelves (can be from different warehouses)
        $shelves = Shelf::inRandomOrder()->take(3)->get();

        // Create a warehouse rental record
        $rental = WarehouseRental::create([
            'merchant_id'  => $merchant->id,
            'rental_start' => Carbon::now()->subMonth(),
            'rental_end'   => Carbon::now()->addMonths(2),
            'price'        => 0, // Placeholder; will update after shelves attached
            'status'       => 1,
            'created_by'   => 'Seeder',
        ]);

        // Attach each shelf to the rental with pivot data
        foreach ($shelves as $shelf) {
            $rental->shelves()->attach($shelf->id, [
                'custom_price' => $shelf->price + rand(50, 150), // simulate a custom price
                'custom_start' => now()->subDays(rand(10, 30)),
                'custom_end'   => now()->addDays(rand(30, 90)),
            ]);
        }

        // Re-fetch the shelves to make sure pivot data is loaded
        $rental->load('shelves');

        // Calculate total custom price from attached shelves
        $total = $rental->shelves->sum(function ($shelf) {
            return $shelf->pivot->custom_price ?? 0;
        });

        // Update rental price with total
        $rental->update(['price' => $total]);
    }
}
