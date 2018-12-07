<?php

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
        $user = App\User::Create([
            'name' => 'admin', 
            'userName' => 'admin', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('pass1234'),
            'user_image' => 'vali/images/users/profile.png',
            'admin' => 1,
            'shop_id' => null
        ]);
        App\User::Create([
            'name' => 'Mahfuz Ahamed', 
            'userName' => 'mafi', 
            'email' => 'mafi@gmail.com',
            'password' => bcrypt('pass1234'),
            'user_image' => 'vali/images/users/profile.png',
            'admin' => 0,
            'shop_id' => 1
        ]);
        App\Manager::Create([
            'name' => 'Mahfuz Ahamed', 
            'user_id' => 2, 
            'shop_id' => 1
        ]);
        App\Shop::Create([
            'name' => 'Shop 1', 
        	'address' => ''
        ]);
    }
}
