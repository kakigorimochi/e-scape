<?php

use App\Model\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Monumento',
            'Bagong Barrio',
            'LRT1 Balintawak',
            'Kaingin Road',
            'LRT1 Roosevelt',
            'MRT North Ave.',
            'MRT Quezon Ave.',
            'Nepa Q-mart',
            'Main Ave. Cubao',
            'MRT3 Santolan',
            'MRT3 Ortigas',
            'Guadalupe Bridge',
            'MRT3 Buendia',
            'Ayala Ave. Bus Stop',
            'Taft Ave.',
            'Roxas Boulevard',
            'DFA Aseana (Temporary)',
            'City of Dreams (Temporary)',
            'PITX'
        ];
        foreach($locations as $location)
            Location::create(['name' => $location]);
    }
}
