<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::where('username','lentrix')->first();
        if($user!=null) {
            \App\Role::create(['user_id' => $user->id, 'role'=>'admin']);
        }
    }
}
