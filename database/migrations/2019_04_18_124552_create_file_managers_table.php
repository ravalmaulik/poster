<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('Type',['ACHIEVEMENT','EVENT','BIOGRAPHY','QUESTION','POST','IDOLS']);
            $table->integer("TypeId")->unsigned();
            $table->string('File',255);
            $table->enum('FileType',['BANNER_IMAGE','IMAGE','VIDEO','LOGO','SPONSORS','PROFILE_IMG']);
            $table->enum('IsLocal',['0','1']);

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
        Schema::dropIfExists('file_managers');
    }
}
