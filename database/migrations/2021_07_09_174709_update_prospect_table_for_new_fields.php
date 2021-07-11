<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProspectTableForNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prospect', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('location');
            $table->dropColumn('source');

            $table->string('prospect_owner')->nullable();
            $table->string('prospect_id')->nullable();
            $table->string('modified_by')->nullable();
            $table->string('prospect_phone')->nullable();
            $table->string('prospect_email')->nullable();
            $table->string('prospect_mobile')->nullable();
            $table->string('prospect_gym')->nullable();
            $table->string('prospect_city')->nullable();
            $table->string('prospect_state')->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('modified_by_name')->nullable();
            $table->string('prospect_first_name')->nullable();
            $table->string('prospect_last_name')->nullable();
            $table->string('prospect_source')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
