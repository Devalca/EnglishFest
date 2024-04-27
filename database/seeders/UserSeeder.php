<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'BOT University',
            'email'=>'saepul.rahman@nusaputra.ac.id',
            'is_admin'=>true,
            'password'=>Hash::make('485,~\KjUWj*yNSazQ_>CG&i'),
            'email_verified_at'=>now(),
            'remember_token'=>Str::random(10),
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ]);
    }
}
