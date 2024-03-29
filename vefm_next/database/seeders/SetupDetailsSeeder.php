<?php

namespace Database\Seeders;

use App\Models\Setup_Details;
use Illuminate\Database\Seeder;

class SetupDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // public function run()
    
        // Generate 10 instances of SetupDetail using the factory
        Setup_Details::factory()->count(10)->create();
    
    }
}
