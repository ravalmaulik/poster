<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MenuName', 50);
            $table->string('MenuIcon', 50);
            $table->string('MenuLink', 100);
            $table->integer('MenuParentId')->unsigned()->nullable();
            $table->timestamps();
            $table->enum('IsActive',['0','1'])->default('1');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('super_admin_menus');
    }
}
