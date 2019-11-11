<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depts = [
            [
                'accronym' => 'PreElem',
                'name' => 'Pre-Elementary',
                'program' => [
                    'accronym'  =>  'Pre-Elem',
                    'name'      =>  'Pre-Elementary',
                    'category'  =>  'pre-elem'
                ]
            ],
            [
                'accronym' => 'Elem',
                'name' => 'Elementary',
                'program' => [
                    'accronym'  =>  'Elem',
                    'name'      =>  'Elementary',
                    'category'  =>  'elem'
                ]
            ],
            [
                'accronym' => 'JHS',
                'name' => 'Junior High School',
                'program' => [
                    'accronym'  =>  'JHS',
                    'name'      =>  'Junior High School',
                    'category'  =>  'jhs'
                ]
            ],
            [
                'accronym' => 'SHS',
                'name' => 'Senior High School',
                'program' => [
                    'accronym'  =>  'SHS',
                    'name'      =>  'Senior High School',
                    'category'  =>  'shs'
                ]
            ],
            [
                'accronym' => 'CAST',
                'name' => 'College of Arts, Sciences & Technology',
                'program' => [
                    'accronym'  =>  'BSIT',
                    'name'      =>  'Bachelor of Science in Information Technology',
                    'category'  =>  'college'
                ]
            ],
            [
                'accronym' => 'CABM-B',
                'name' => 'College of Accountancy, Business & Mgt. - Business',
                'program' => [
                    'accronym'  =>  'BSA',
                    'name'      =>  'Bachelor of Science in Accountancy',
                    'category'  =>  'college'
                ]
            ],
            [
                'accronym' => 'CABM-H',
                'name' => 'College of Accountancy, Business & Mgt. - Hospitality',
                'program' => [
                    'accronym'  =>  'BSHRM',
                    'name'      =>  'Bachelor of Science in Hotel & Restaurant Management',
                    'category'  =>  'college'
                ]
            ],
            [
                'accronym' => 'CCJ',
                'name' => 'College of Criminal Justice',
                'program' => [
                    'accronym'  =>  'BSCRIM',
                    'name'      =>  'Bachelor of Science in Criminology',
                    'category'  =>  'college'
                ]
            ],
            [
                'accronym' => 'COE',
                'name' => 'College of Education',
                'program' => [
                    'accronym'  =>  'BEED',
                    'name'      =>  'Bachelor of Elementary Education',
                    'category'  =>  'college'
                ]
            ],
            [
                'accronym' => 'CON',
                'name' => 'College of Nursing',
                'program' => [
                    'accronym' =>   'BSN',
                    'name'      =>  'Bachelor of Science in Nursing',
                    'category'  =>  'college'
                ]
            ],
        ];

        foreach($depts as $dept) {
            $d = \App\Department::create([
                'accronym' => $dept['accronym'],
                'name' => $dept['name']
            ]);
            $d->programs()->create($dept['program']);
        }
    }
}
