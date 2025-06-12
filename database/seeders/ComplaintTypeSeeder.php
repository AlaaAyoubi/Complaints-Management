<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComplaintType;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ComplaintType::create(['type' => 'Techincal Issue']);
        ComplaintType::create(['type' => 'Service Quality']);
        ComplaintType::create(['type' => 'Billing Inquiry']);
        ComplaintType::create(['type' => 'General Feedback']);
    }
}
