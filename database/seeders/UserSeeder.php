<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Aaziiraa',
            'username' => 'aaziiraa',
            'address' => 'Gg Keluarga No.18 Rintis Kota Pekanbaru',
            'email' => 'aaziiraa@gmail.com',
        ]);

        User::factory(10)->create();
    }
}
