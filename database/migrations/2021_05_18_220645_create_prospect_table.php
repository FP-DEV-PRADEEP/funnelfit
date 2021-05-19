<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospect', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name'); //searchable
            $table->string('email')->unique(); //searchable
            $table->integer('phone')->unique(); //searchable
            $table->string('location'); //filter
            $table->string('source');
            $table->dateTime('date'); //date picker
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospect');
    }
}
