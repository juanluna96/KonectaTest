<?php

use App\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Rol::create([
            'descripcion' => 'Admin'
        ]);

        $seller = Rol::create([
            'descripcion' => 'Vendedor'
        ]);

        $client = Rol::create([
            'descripcion' => 'Cliente'
        ]);
    }
}
