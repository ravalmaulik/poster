<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MenuName', 50);
            $table->string('MenuLink', 100);
            $table->integer('MenuParentId')->unsigned()->nullable();
            $table->timestamps();
            $table->integer('CreatedBy')->unsigned()->nullable();
            $table->integer('UpdatedBy')->unsigned()->nullable();
            $table->enum('IsActive',['0','1'])->default('1');
            $table->softDeletes();

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
        Schema::dropIfExists('client_menus');
    }
}
