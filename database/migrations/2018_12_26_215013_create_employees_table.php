<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');

            $table->string('cellphone_personal');
            $table->string('phone_personal');
            $table->string('adress_personal');
            $table->unsignedInteger('city_adress_id');

            $table->text('hobbies');
            $table->text('mental_rest');

            $table->unsignedInteger('position_id');
            $table->unsignedInteger('city_id');



            $table->string('salary');
            $table->string('cellphone_corporate')->nullable();
            $table->string('email_corporate',50)->nullable();
            $table->string('Bogota_bank_account_id')->nullable();
            $table->string('secment_id');

            $table->unsignedInteger('academic_level_id');
            $table->unsignedInteger('studing');
            $table->unsignedInteger('profession_id');
            $table->unsignedInteger('civil_status_id');

            $table->date('birthdate');

            $table->unsignedInteger('status_id')->default(1);
            $table->unsignedInteger('eps_id');
            $table->unsignedInteger('ccf_id');
            $table->unsignedInteger('afp_id');
            $table->unsignedInteger('arl_id');
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
        Schema::dropIfExists('employees');
    }
}
