<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatatableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datatable', function (Blueprint $table) {
            $table->id();
            $table->integer('admins_id')->unsigned();
            $table->enum('type',['info','form','html','json'])->nullable();
            $table->string('category')->nullable();
            $table->string('key')->nullable();
            $table->string('title')->nullable();
            $table->text('data')->nullable();
            $table->string('route')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('datatable');
    }
}
