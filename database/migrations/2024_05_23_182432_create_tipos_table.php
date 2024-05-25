<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tip_tipo_doc', function (Blueprint $table) {
            $table->id('TIP_ID');
            $table->string('TIP_NOMBRE')->unique();
            $table->string('TIP_PREFIJO')->unique()->index(); // Añadiendo índice
            $table->timestamps();
        });

        // Insertar datos precargados
        DB::table('tip_tipo_doc')->insert([
            ['TIP_NOMBRE' => 'Instructivo', 'TIP_PREFIJO' => 'INS'],
            ['TIP_NOMBRE' => 'Manual', 'TIP_PREFIJO' => 'MAN'],
            ['TIP_NOMBRE' => 'Procedimiento', 'TIP_PREFIJO' => 'PRO'],
            ['TIP_NOMBRE' => 'Política', 'TIP_PREFIJO' => 'POL'],
            ['TIP_NOMBRE' => 'Guía', 'TIP_PREFIJO' => 'GUI']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tip_tipo_doc');
    }
}
