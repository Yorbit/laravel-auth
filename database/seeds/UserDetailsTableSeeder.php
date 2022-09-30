<?php

use App\Models\Admin\UserDetail;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        
        foreach($users as $user) {
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->address = $faker->address();
            $userDetail->phone_number = $faker->phoneNumber();
            $userDetail->save();
        }
    }
}
