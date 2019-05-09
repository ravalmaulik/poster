<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTypeAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_type_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('MemberTypeId')->unsigned();
            $table->integer('MenuId')->unsigned();

            $table->timestamps();
            $table->integer('CreatedBy')->unsigned()->nullable();
            $table->integer('UpdatedBy')->unsigned()->nullable();
            $table->enum('IsActive',['0','1'])->default('1');
            $table->softDeletes();

            // $table->foreign('ClientId')->references('id')->on('clients');
            $table->foreign('CreatedBy')->references('id')->on('super_admin_users');
            $table->foreign('UpdatedBy')->references('id')->on('super_admin_users');
            $table->foreign('MemberTypeId')->references('id')->on('member_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_type_accesses');
    }
}
