<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin				= new User();
        $superAdmin->password 	= bcrypt('password');
        $superAdmin->email		= 'admin@travelspot.id';
        $superAdmin->name		= 'Agus Ma\'ruf';
        $superAdmin->role_id	= 1;
        $superAdmin->save();
    }
}
