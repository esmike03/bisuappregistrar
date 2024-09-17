<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('holidays')->insert([
            ['holiday_date' => '2024-01-01', 'name' => "New Year's Day"],
            ['holiday_date' => '2024-04-09', 'name' => 'Araw ng Kagitingan'],
            ['holiday_date' => '2024-04-10', 'name' => 'Maundy Thursday'],
            ['holiday_date' => '2024-04-11', 'name' => 'Good Friday'],
            ['holiday_date' => '2024-05-01', 'name' => 'Labor Day'],
            ['holiday_date' => '2024-06-12', 'name' => 'Independence Day'],
            ['holiday_date' => '2024-08-21', 'name' => 'Ninoy Aquino Day'],
            ['holiday_date' => '2024-11-30', 'name' => 'Bonifacio Day'],
            ['holiday_date' => '2024-12-25', 'name' => 'Christmas Day'],
            ['holiday_date' => '2024-12-30', 'name' => 'Rizal Day'],
        ]);
    }
}
