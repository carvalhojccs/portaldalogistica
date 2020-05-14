<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensEmpenhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_empenhos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('empenho_id');
            $table->foreign('empenho_id')->references('id')->on('empenhos');
            $table->unsignedBigInteger('status_item_empenho_id');
            $table->foreign('status_item_empenho_id')->references('id')->on('status_itens_empenhos');
            $table->string('descricao');
            $table->integer('quantidade');
            $table->decimal('valor',10,2);
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
        Schema::dropIfExists('itens_empenhos');
    }
}
