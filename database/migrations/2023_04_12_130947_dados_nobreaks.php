<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dados_nobreaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_equipamento');
            $table->timestamp('data_hora');
            $table->integer('tensao_input');
            $table->integer('tensao_output');
            $table->integer('temperatura');
            $table->string('status', 20);
            $table->integer('carga_bateria');
            $table->integer('autonomia_bateria');
            $table->integer('tensao_bateria');
            $table->integer('frequencia_input');
            $table->integer('carga_saida');
            $table->integer('tensao_saida');
            $table->integer('frequencia_saida');
            $table->string('tipo_saida', 20)->nullable();
            $table->timestamps();
            $table->foreign('id_equipamento')->references('id')->on('equipamentos');
            $table->dropForeign('dados_nobreaks_id_equipamento_foreign');
            $table->foreign('id_equipamento')->references('id')->on('equipamentos');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
