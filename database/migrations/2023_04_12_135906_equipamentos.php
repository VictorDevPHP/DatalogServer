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
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('ip', 15);
            $table->integer('porta')->default(161);
            $table->string('versao_protocolo');
            $table->string('comunidade_snmp')->default('public');
            $table->string('usuario_snmp')->nullable();
            $table->string('senha_snmp')->nullable();
            $table->timestamps();
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
