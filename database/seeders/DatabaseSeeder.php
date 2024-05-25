<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pro_proceso')->insert([
            ['PRO_NOMBRE' => 'Ingenieria', 'PRO_PREFIJO' => 'ING'],
            ['PRO_NOMBRE' => 'Contabilidad', 'PRO_PREFIJO' => 'CON'],
            ['PRO_NOMBRE' => 'Recursos Humanos', 'PRO_PREFIJO' => 'RH'],
            ['PRO_NOMBRE' => 'Ventas', 'PRO_PREFIJO' => 'VEN'],
            ['PRO_NOMBRE' => 'Marketing', 'PRO_PREFIJO' => 'MAR'],
        ]);

        DB::table('tip_tipo_doc')->insert([
            ['TIP_NOMBRE' => 'Instructivo', 'TIP_PREFIJO' => 'INS'],
            ['TIP_NOMBRE' => 'Manual', 'TIP_PREFIJO' => 'MAN'],
            ['TIP_NOMBRE' => 'Procedimiento', 'TIP_PREFIJO' => 'PROC'],
            ['TIP_NOMBRE' => 'Política', 'TIP_PREFIJO' => 'POL'],
            ['TIP_NOMBRE' => 'Reglamento', 'TIP_PREFIJO' => 'REG'],
        ]);
    }
}
