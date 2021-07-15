<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistorias', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->time('hora');
            $table->string('placa', 7);
            $table->string('outro', 60)->nullable();

            $table->unsignedInteger('servico_id');
			$table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            
            $table->unsignedInteger('modelo_id')->nullable();
			$table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');

            $table->unsignedInteger('cliente_id');
			$table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->unsignedInteger('cidade_id');
			$table->foreign('cidade_id')->references('id')->on('cidades')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistorias');
    }
}
