<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\BusinessHourSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BusinessHourSeeder::class
        ]);    
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111'),
            'remember_token' => 'yXdaDkfSXfjO9dQS3cd1HOSpDhFkE7W1jcuLf8fXOrpqEOf6zMGvn4nV1uaT',
        ]);
    }
}
