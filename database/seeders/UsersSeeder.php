<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->upsert([
            ['name'=>'Admin', 'email'=>'admin@example.com', 'password'=>bcrypt('123456789'), 'role'=>'admin', 'created_at'=>\Carbon\Carbon::now(), 'updated_at'=>\Carbon\Carbon::now()],
            ['name'=>'Encadrant Faculté', 'email'=>'encfac@example.com', 'password'=>bcrypt('password'), 'role'=>'encadrant', 'created_at'=>\Carbon\Carbon::now(), 'updated_at'=>\Carbon\Carbon::now()],
        ], ['email']);

    }
}
