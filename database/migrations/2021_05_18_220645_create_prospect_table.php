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
            $table->string('name'); //searchable
            $table->string('email')->unique(); //searchable
            $table->string('phone'); //searchable
            $table->string('location')->nullable(); //filter
            $table->string('source')->nullable();
            $table->timestamp('date');
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
        Schema::dropIfExists('prospect');
    }
}
