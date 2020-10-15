<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => "user@gmail.com",
            'password' => Hash::make('123456'),
            'tipo_usuario' => "1",
        ]);
    }
}
