<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(PeriodsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        // $this->call(StudentsTableSeeder::class);
        $this->call(StrandsTableSeeder::class);

    }
}
