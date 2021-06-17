<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('name');
            $table->string('email')->unique()->notNullable();
            $table->string('password');
            $table->string('status');
            $table->integer('id_distribuidor')->nullable();
            $table->foreign('id_distribuidor', 'user_distribuidor_fk')->references('id_distribuidor')->on('distribuidor');
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
        Schema::dropIfExists('users');
    }
}
