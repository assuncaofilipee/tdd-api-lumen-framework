<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePosAplicativoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_aplicativo', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id_pos_aplicativo');
            $table->string('nm_pos_aplicativo',50)->nullable();
            $table->string('nr_versao',15);
            $table->boolean('tp_principal');
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
        Schema::dropIfExists('pos_aplicativo');
    }
}
