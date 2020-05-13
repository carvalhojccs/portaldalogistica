<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapelPermissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papel_permissao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permissao_id');
            $table->foreign('permissao_id')->references('id')->on('permissoes');
            $table->unsignedBigInteger('papel_id');
            $table->foreign('papel_id')->references('id')->on('papeis');
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
        Schema::dropIfExists('papel_permissao');
    }
}
