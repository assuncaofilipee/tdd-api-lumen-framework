<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribuidorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuidor', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id_distribuidor');
            $table->timestamp('dt_cadastro')->nullable();
            $table->string('nu_telefone',20)->nullable();
            $table->string('nu_celular',20)->nullable();
            $table->string('nm_distribuidor',200)->nullable();
            $table->string('ds_razao_social',200)->nullable();
            $table->string('ds_nome_fantasia',200)->nullable();
            $table->string('nu_documento',20)->nullable();
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
        Schema::dropIfExists('distribuidor');
    }
}
