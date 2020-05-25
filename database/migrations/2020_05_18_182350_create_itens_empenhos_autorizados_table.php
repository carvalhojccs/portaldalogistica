<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensEmpenhosAutorizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_empenhos_autorizados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_empenho_id');
            $table->foreign('item_empenho_id')->references('id')->on('itens_empenhos');
            $table->decimal('autorizado',10,2);
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
        Schema::dropIfExists('itens_empenhos_autorizados');
    }
}
