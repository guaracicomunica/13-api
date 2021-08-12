<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'Preto',
                'hex_code' => '#000000'
            ],
            [
                'name' => 'Branco',
                'hex_code' => '#FFFFFF'
            ],
            [
                'name' => 'Cinza',
                'hex_code' => '#E0E0E0'
            ],
            [
                'name' => 'Vermelho',
                'hex_code' => '#EF476F'
            ],
            [
                'name' => 'Azul',
                'hex_code' => '#118AB2'
            ],
            [
                'name' => 'Verde',
                'hex_code' => '#06D6A0'
            ],
            [
                'name' => 'Amarelo',
                'hex_code' => '#FFD166'
            ],
            [
                'name' => 'Roxo',
                'hex_code' => '#8338EC'
            ],
            [
                'name' => 'Marrom',
                'hex_code' => '#9C6644'
            ]
        ];

        foreach($colors as $color) {
            Color::create([
                'name' => $color['name'],
                'hex_code' => $color['hex_code']
            ]);
        }
    }
}
