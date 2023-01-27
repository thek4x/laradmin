<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_forms', function (Blueprint $table) {
            $table->id();
            $table->string('form_page');
            $table->integer('form_pageid')->default(0);
            $table->string('form_column')->nullable()->unsigned()->default(6);
            $table->string('form_label')->nullable();
            $table->text('form_input');
            $table->text('form_inputvalue')->nullable();
            $table->string('form_name')->nullable()->unique();
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
        Schema::dropIfExists('page_forms');
    }
}
