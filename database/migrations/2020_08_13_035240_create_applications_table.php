<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->index();
            $table->string('name');
            $table->string('personal_id')->unique();
            $table->string('status')->default('draft');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('applicant_group_id')->unsigned()->nullable();
            $table->bigInteger('manager_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('set null');

            $table->foreign('applicant_group_id')
                ->references('id')
                ->on('applicant_groups')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
