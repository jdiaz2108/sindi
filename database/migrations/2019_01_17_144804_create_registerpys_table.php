<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterpysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registerpys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('conceptpys_id');
            $table->string('status');
            $table->string('discount')->nullable();
            $table->string('sign')->nullable();
            $table->string('signer');
            $table->longText('observations')->nullable();
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
        Schema::dropIfExists('registerpys');
    }
}
