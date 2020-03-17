<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levs = [
            [
                'code' => 'K1',
                'name' => 'Kindergarten 1',
                'category' => 'pre-elem'
            ],
            [
                'code' => 'K2',
                'name' => 'Kindergarten 2',
                'category' => 'pre-elem'
            ],
            [
                'code' => 'G1',
                'name' => 'Grade 1',
                'category' => 'elem'
            ],
            [
                'code' => 'G2',
                'name' => 'Grade 2',
                'category' => 'elem'
            ],
            [
                'code' => 'G3',
                'name' => 'Grade 3',
                'category' => 'elem'
            ],
            [
                'code' => 'G4',
                'name' => 'Grade 4',
                'category' => 'elem'
            ],
            [
                'code' => 'G5',
                'name' => 'Grade 5',
                'category' => 'elem'
            ],
            [
                'code' => 'G6',
                'name' => 'Grade 6',
                'category' => 'elem'
            ],
            [
                'code' => 'G7',
                'name' => 'Grade 7',
                'category' => 'jhs'
            ],
            [
                'code' => 'G8',
                'name' => 'Grade 8',
                'category' => 'jhs'
            ],
            [
                'code' => 'G9',
                'name' => 'Grade 9',
                'category' => 'jhs'
            ],
            [
                'code' => 'G10',
                'name' => 'Grade 10',
                'category' => 'jhs'
            ],
            [
                'code' => 'G11',
                'name' => 'Grade 11',
                'category' => 'shs'
            ],
            [
                'code' => 'G12',
                'name' => 'Grade 12',
                'category' => 'shs'
            ],
            [
                'code' => '1',
                'name' => 'First Year College',
                'category' => 'college'
            ],
            [
                'code' => '2',
                'name' => 'Second Year College',
                'category' => 'college'
            ],
            [
                'code' => '3',
                'name' => 'Third Year College',
                'category' => 'college'
            ],
            [
                'code' => '4',
                'name' => 'Fourth Year College',
                'category' => 'college'
            ],
        ];

        foreach($levs as $lev) {
            Level::create($lev);
        }

    }
}
