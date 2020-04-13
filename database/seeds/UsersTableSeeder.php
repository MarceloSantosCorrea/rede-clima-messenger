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
        factory(App\Models\User::class)->create([
            'name'     => 'Marcelo Corrêa',
            'email'    => 'marcelocorrea229@gmail.com',
            'is_admin' => '1',
        ]);

        factory(App\Models\User::class, 5)->create([
            'is_admin' => '0',
        ]);
    }
}
