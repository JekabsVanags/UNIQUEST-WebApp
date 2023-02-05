<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Level;
class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level->insert(
            [
                'title'=>'Peterbaznica',
                'coverImage'=>'Peterbaznica.jpg',
                'description'=>'Kur vienā vietā ir pēteris un gailis?',
                'rating'=>3,
                'isPublic'=>1,
                'dificulty'=>1,
                'user_id'=>0,
                'location_id'=>1,
            ]
            );
            Level->insert(
                [
                    'title'=>'Tilts',
                    'coverImage'=>'Likais_tilts.jpg',
                    'description'=>'Ej pie milža un virs zušiem.',
                    'rating'=>1,
                    'isPublic'=>1,
                    'dificulty'=>5,
                    'user_id'=>0,
                    'location_id'=>2,
                ]
                );
    }
}
