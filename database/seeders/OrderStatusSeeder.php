<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allStatus = [
            [
                'name' => 'Pedido Realizado',
            ],
            [
                'name' => 'Pagamento Confirmado',
            ],
            [
                'name' => 'Em Preparo',
            ],
            [
                'name' => 'Em Transporte',
            ],
            [
                'name' => 'Pedido Entregue',
            ],
        ];

        foreach($allStatus as $status) {
            OrderStatus::create([
                'name' => $status['name'],
            ]);
        }
    }
}
