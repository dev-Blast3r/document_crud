<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_proceso', function (Blueprint $table) {
            $table->id('PRO_ID');
            $table->string('PRO_NOMBRE')->unique();
            $table->string('PRO_PREFIJO')->unique()->index();
            $table->timestamps();
        });

        // Insertar datos precargados
        DB::table('pro_proceso')->insert([
            ['PRO_NOMBRE' => 'Ingenieria', 'PRO_PREFIJO' => 'ING'],
            ['PRO_NOMBRE' => 'Finanzas', 'PRO_PREFIJO' => 'FIN'],
            ['PRO_NOMBRE' => 'Recursos Humanos', 'PRO_PREFIJO' => 'RH'],
            ['PRO_NOMBRE' => 'Marketing', 'PRO_PREFIJO' => 'MKT'],
            ['PRO_NOMBRE' => 'Ventas', 'PRO_PREFIJO' => 'VTA']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_proceso');
    }
}
