<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::truncate();

        // You can create multiple users like this:
        User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'type' => 'Writer',
            'status' => 'Active',
        ]);

        User::create([
            'firstname' => 'Jane',
            'lastname' => 'Smith',
            'type' => 'Editor',
            'status' => 'Active',
        ]);
    }
}
