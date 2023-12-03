<?php

namespace Database\Seeders;

use App\Models\Login_Token;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Login_TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Login_Token::factory()->count(10)->create();
    }
}
