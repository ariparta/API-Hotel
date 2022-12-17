<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'address' => 'Admin address',
            'phone_number' => '0976767576567',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => 'admin',
        ]);
    }
}
