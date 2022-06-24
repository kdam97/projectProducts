<?php

use Illuminate\Database\Seeder;

class CategoriasSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Productos de consumo básico',
            ],
            [
                'nombre' => 'Productos de emergencia',
            ],
            [
                'nombre' => 'Productos de impulso',
            ],
            [
                'nombre' => 'Servicios',
            ],
        ]);
    }
}
