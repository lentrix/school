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
                    'name'      =>  'Pre-Elementary'
                ]
            ],
            [
                'accronym' => 'Elem',
                'name' => 'Elementary',
                'program' => [
                    'accronym'  =>  'Elem',
                    'name'      =>  'Elementary'
                ]
            ],
            [
                'accronym' => 'JHS',
                'name' => 'Junior High School',
                'program' => [
                    'accronym'  =>  'JHS',
                    'name'      =>  'Junior High School'
                ]
            ],
            [
                'accronym' => 'SHS',
                'name' => 'Senior High School',
                'program' => [
                    'accronym'  =>  'SHS',
                    'name'      =>  'Senior High School'
                ]
            ],
            [
                'accronym' => 'CAST',
                'name' => 'College of Arts, Sciences & Technology',
                'program' => [
                    'accronym'  =>  'BSIT',
                    'name'      =>  'Bachelor of Science in Information Technology'
                ]
            ],
            [
                'accronym' => 'CABM-B',
                'name' => 'College of Accountancy, Business & Mgt. - Business',
                'program' => [
                    'accronym'  =>  'BSA',
                    'name'      =>  'Bachelor of Science in Accountancy'
                ]
            ],
            [
                'accronym' => 'CABM-H',
                'name' => 'College of Accountancy, Business & Mgt. - Hospitality',
                'program' => [
                    'accronym'  =>  'BSHRM',
                    'name'      =>  'Bachelor of Science in Hotel & Restaurant Management'
                ]
            ],
            [
                'accronym' => 'CCJ',
                'name' => 'College of Criminal Justice',
                'program' => [
                    'accronym'  =>  'BSCRIM',
                    'name'      =>  'Bachelor of Science in Criminology'
                ]
            ],
            [
                'accronym' => 'COE',
                'name' => 'College of Education',
                'program' => [
                    'accronym'  =>  'BEED',
                    'name'      =>  'Bachelor of Elementary Education'
                ]
            ],
            [
                'accronym' => 'CON',
                'name' => 'College of Nursing',
                'program' => [
                    'accronym' =>   'BSN',
                    'name'      =>  'Bachelor of Science in Nursing'
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
