<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Pippo';
        $user->email = 'pippo@mail.it';
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
