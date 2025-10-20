<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $business = Business::first() ?? Business::factory()->create();
        Unit::factory(20)->create([
            'business_id' => $business->id,
        ]);
    }
}
