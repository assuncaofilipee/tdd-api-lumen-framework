<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id_pos');
            $table->string('nm_pos',50)->nullable();
            $table->string('nm_modelo',50)->nullable();
            $table->string('nm_terminal',25);
            $table->string('nr_serie',100);
            $table->integer('id_pos_situacao')->nullable();
            $table->foreign('id_pos_situacao', 'pos_situacao_fk')->references('id_pos_situacao')->on('pos_situacao');
            $table->integer('id_distribuidor')->nullable();
            $table->foreign('id_distribuidor', 'pos_distribuidor_fk')->references('id_distribuidor')->on('distribuidor');
            $table->integer('id_cliente')->nullable();
            $table->foreign('id_cliente', 'pos_cliente_fk')->references('id_cliente')->on('cliente');
            $table->integer('id_pos_aplicativo')->nullable();
            $table->foreign('id_pos_aplicativo', 'pos_aplicativo_fk')->references('id_pos_aplicativo')->on('pos_aplicativo');
            $table->string('nu_pos',100)->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos');
    }
}
