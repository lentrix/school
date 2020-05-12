<?php

use App\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shsCourses = [
            [
                'description' => 'Oral Communication',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => '21st Century Literature from the Philippines and the World',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'General Mathematics',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Earth Science',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Introduction to the Philosophy of the Human Person',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'PE and Health',
                'type' => 'Core',
                'hours' => 20,
            ],
            [
                'description' => 'General Biology 1',
                'type' => 'Specialized',
                'hours' => 80,
            ],
            [
                'description' => 'General Physics 1',
                'type' => 'Specialized',
                'hours' => 80,
            ],
            [
                'description' => 'Reading and Writing',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Pagbasa ang Pagsusuri ng Ibat-Ibang Teksto Tungo sa Pananaliksik',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Statistics and Probability',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Disaster Readiness and Risk Reduction',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Understanding Society, Culture, and Politics',
                'type' => 'Core',
                'hours' => 80,
            ],
            [
                'description' => 'Practical Research',
                'type' => 'Applied',
                'hours' => 80,
            ],
            [
                'description' => 'General Biology 2',
                'type' => 'Specialized',
                'hours' => 80,
            ],
            [
                'description' => 'General Physics 2',
                'type' => 'Specialized',
                'hours' => 80,
            ],
        ];

        foreach($shsCourses as $shsCourse) {
            Course::create([
                'type' => $shsCourse['type'],
                'description' => $shsCourse['description'],
                'units' => 1,
                'hours' => $shsCourse['hours'],
                'academic' => 1,
                'program_id' => 4
            ]);
        }
    }
}
