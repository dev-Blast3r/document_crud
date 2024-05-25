<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_documento', function (Blueprint $table) {
            $table->id('DOC_ID');
            $table->string('DOC_NOMBRE');
            $table->string('DOC_CODIGO')->unique()->index(); // Añadiendo índice
            $table->text('DOC_CONTENIDO');
            $table->foreignId('DOC_ID_TIPO')->constrained('tip_tipo_doc', 'TIP_ID')->onDelete('cascade');
            $table->foreignId('DOC_ID_PROCESO')->constrained('pro_proceso', 'PRO_ID')->onDelete('cascade');
            $table->timestamps();

            // Añadiendo índice compuesto
            $table->index(['DOC_ID_TIPO', 'DOC_ID_PROCESO']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_documento');
    }
}
