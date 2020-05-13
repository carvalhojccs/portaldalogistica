<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpenhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    
    {
        Schema::create('empenhos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tipo_item_id');
            $table->foreign('tipo_item_id')->references('id')->on('tipos_itens');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unsignedBigInteger('linha_credito_id');
            $table->foreign('linha_credito_id')->references('id')->on('linhas_creditos');
            $table->unsignedBigInteger('natureza_id');
            $table->foreign('natureza_id')->references('id')->on('naturezas');
            $table->unsignedBigInteger('status_empenho_id');
            $table->foreign('status_empenho_id')->references('id')->on('status_empenhos');
            $table->string('solicitacao',7)->unique();
            $table->date('data_solicitacao');
            $table->decimal('valor_solicitacao',10,2);
            $table->string('processo');
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
        Schema::dropIfExists('empenhos');
    }
}
