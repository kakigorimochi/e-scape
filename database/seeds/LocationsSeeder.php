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
            'LRT 1 Balintawak',
            'Kaingin Road',
            'LRT 1 Roosevelt',
            'MRT 3 North Ave.',
            'MRT 3 Quezon Ave.',
            'Nepa Q-mart',
            'Main Ave. Cubao',
            'MRT 3 Santolan',
            'MRT 3 Ortigas',
            'Guadalupe Bridge',
            'MRT 3 Buendia',
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
