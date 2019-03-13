<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->nullable();
            $table->integer('user_id');
            $table->string('date_elaboration');
            $table->string('type')->nullable();
            $table->string('motivo')->nullable();
            $table->string('date')->nullable();
            $table->string('horaini')->nullable();
            $table->string('horafin')->nullable();
            $table->longText('description')->nullable();
            $table->integer('aprobado_user_id')->nullable();
            $table->integer('remunerado')->nullable();
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
        Schema::dropIfExists('permisos');
    }
}
