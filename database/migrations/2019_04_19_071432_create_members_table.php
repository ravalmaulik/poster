<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name',255);
            $table->enum('Gender',['M','F','O']);
            $table->string('Address',255);
            $table->string('Email',255);
            $table->string('Phone',20);
            $table->string('City',20);
            $table->string('State',20);
            $table->string('Zip',20);
            $table->dateTime('DateOfBirth');
            $table->dateTime('RegistationDate');
            $table->integer('DesginationId')->unsigned();
            $table->integer('MemberType')->unsigned();
            $table->string('Password',255);
            $table->string('DeviceToken',500);
            $table->integer("ClientId")->unsigned();

            $table->timestamps();
            $table->integer('CreatedBy')->unsigned()->nullable();
            $table->integer('UpdatedBy')->unsigned()->nullable();
            $table->enum('IsActive',['0','1'])->default('1');
            $table->softDeletes();

            $table->foreign('ClientId')->references('id')->on('clients');
            $table->foreign('CreatedBy')->references('id')->on('super_admin_users');
            $table->foreign('UpdatedBy')->references('id')->on('super_admin_users');
            $table->foreign('DesginationId')->references('id')->on('designations');
            $table->foreign('MemberType')->references('id')->on('member_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
