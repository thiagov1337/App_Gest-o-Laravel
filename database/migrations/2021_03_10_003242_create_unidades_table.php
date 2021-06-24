<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //um pra muitos

        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unidade', 5);
            $table->string('descricao', 30);
        });

        // adicionar relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });  

        // adicionar relacionamento com a tabela produto_detalhe
        Schema::table('produto_detalhe', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // remover relacionamento com a tabela produto_detalhe
        Schema::table('produto_detalhe', function (Blueprint $table) {
            // remover fk
            $table->dropForeign('produto_detalhe_unidade_id_foreign');
            // remover a coluna unidade_id
            $table->dropColumn('unidade_id');
        });  
        
        // remover relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            // remover fk
            $table->dropForeign('produtos_unidade_id_foreign');
            // remover a coluna unidade_id
            $table->dropColumn('unidade_id');
        });  

        Schema::dropIfExists('unidades');
    }
}
