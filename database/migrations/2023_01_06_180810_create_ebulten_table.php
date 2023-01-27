<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbultenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebulten', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('eposta')->unique();
            $table->string('group')->nullable();
            $table->tinyInteger('work')->default(1);
            $table->ipAddress('ip');
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
        Schema::dropIfExists('ebulten');
    }
}
