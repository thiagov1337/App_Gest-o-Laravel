<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutosRelacionamentoFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // criando a coluna em produtos que vai receber a fk de fornecedores 
        Schema::table('produtos', function (Blueprint $table) {
            
            //insere um registro de fornecedor para estabelecer o relacionamento
            $fornecedorID = DB::table('fornecedores')->insertGetId([
                'name' => 'fornecedor padrão SG',
                'site' => 'fornecedorpadrãoSG.com.br',
                'uf' => 'SP',
                'email' => 'contato@fornecedorpadrãoSG.com.br',
            ]);

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedorID)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropforeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
}
