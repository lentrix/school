<?php

use Illuminate\Database\Seeder;

class StrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strands = [
            ['track'=>'STEM', 'strand'=>'ICT'],
            ['track'=>'STEM', 'strand'=>'Engineering'],
            ['track'=>'STEM', 'strand'=>'Medical'],
            ['track'=>'HUMSS', 'strand'=>''],
            ['track'=>'ABM', 'strand'=>'Business'],
            ['track'=>'ABM', 'strand'=>'Accountancy'],
            ['track'=>'GAS', 'strand'=>''],
        ];

        foreach($strands as $strand) {
            \App\Strand::create($strand);
        }
    }
}
