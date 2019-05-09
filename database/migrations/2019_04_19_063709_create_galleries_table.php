<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Title',255);
            $table->longText('Description');
            $table->dateTime('DateTime');
            $table->string('Location',255);
            $table->integer("ClientId")->unsigned();

            $table->timestamps();
            $table->integer('CreatedBy')->unsigned()->nullable();
            $table->integer('UpdatedBy')->unsigned()->nullable();
            $table->enum('IsActive',['0','1'])->default('1');
            $table->softDeletes();

            $table->foreign('ClientId')->references('id')->on('clients');
            $table->foreign('CreatedBy')->references('id')->on('super_admin_users');
            $table->foreign('UpdatedBy')->references('id')->on('super_admin_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
