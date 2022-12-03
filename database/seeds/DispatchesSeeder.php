<?php

use App\Model\Dispatch;
use App\Model\Location;
use Illuminate\Database\Seeder;

class DispatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dispatch::truncate();
        $locations = Location::all();
        foreach($locations as $location) {
            Dispatch::create([
                'location_id' => $location->id,
                'tickets' => rand(0, 255)
            ]);
        }
    }
}
