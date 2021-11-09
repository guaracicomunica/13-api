<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\App;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            User::factory(10)->create();
        } else {
            User::create([
                'name' => 'João Paulo',
                'email' => 'joaopaulopmedeiros@gmail.com',
                'email_verified_at' => '2021-11-09 00:00:00',
                'cpf' => '123.123.123-12',
                'password' => Hash::make('123456'),
                'remember_token' => 'ksjdkskdjjfnehglhglhheghkghe',
            ]);
        }
    }
}
