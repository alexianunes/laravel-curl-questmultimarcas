<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('idusuario')->comment('Armazena a chave estrangeira que liga ao usuário que capturou o carro');
            $table->unsignedInteger('idcarro')->comment('Armazena a chave estrangeira que liga ao carro encontrado');
            $table->string('nome_veiculo');
            $table->string('img');
            $table->string('link');
            $table->string('ano');
            $table->string('combustivel');
            $table->string('quilometragem');
            $table->string('cambio');
            $table->string('portas');
            $table->string('cor');
            $table->decimal('preco', 10, 2);
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
        Schema::dropIfExists('artigos');
    }
}
