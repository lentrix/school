<?php

use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = [
            [
                'accronym' => '1T1819',
                'name' => 'First Semester AY 2018-2019',
                'start' => '2018-06-18',
                'end' => '2018-10-23',
                'type' => 'semestral',
                'status' => 'expired'
            ],
            [
                'accronym' => '2T1819',
                'name' => 'Second Semester AY 2018-2019',
                'start' => '2018-10-29',
                'end' => '2019-03-23',
                'type' => 'semestral',
                'status' => 'midterm'
            ], 
            [
                'accronym' => 'AY 2018-2019',
                'name' => 'Academic Year 2018-2019',
                'start' => '2018-06-18',
                'end' => '2019-03-23',
                'type' => 'annual',
                'status' => 'Q3'
            ],
            
        ];

        foreach($periods as $period) {
            App\Period::create($period);
        }
    }
}
