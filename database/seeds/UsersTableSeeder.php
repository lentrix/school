<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = App\User::create([
            'username'=>'lentrix',
            'lname' => 'Lenteria',
            'fname' => 'Benjie',
            'mname' => 'Basio',
            'address' => 'Pob. Centro, Clarin, Bohol',
            'phone' => '0917.303.5716',
            'field' => 'Computer Science',
            'active' => 1,
            'dept_id' => 5,
            'password' => bcrypt('password123')
        ]);

        factory(User::class, 30)->create();
    }
}
