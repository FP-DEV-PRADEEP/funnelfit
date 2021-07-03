<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_logs', function (Blueprint $table) {
            $table->id();
            $table->string('owner')->nullable();
            $table->string('zoho_id')->nullable();
            $table->string('subject')->nullable();
            $table->dateTime('created_time')->nullable();
            $table->dateTime('modified_time')->nullable();
            $table->string('modified_by')->nullable();
            $table->integer('call_duration_sec')->nullable();
            $table->time('call_duration')->nullable();
            $table->string('lead_name')->nullable();
            $table->string('call_direction')->nullable();
            $table->string('caller_type')->nullable();
            $table->dateTime('call_start_time')->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('modified_by_name')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('call_logs');
    }
}
