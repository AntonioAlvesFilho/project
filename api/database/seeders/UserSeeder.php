<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      factory(User::class)->created([
				'name' => 'Antonio'
				'email' => 'antonio@antonio.com'
			]);
			\App\Models\User::factory(10)->create();
    }
}
