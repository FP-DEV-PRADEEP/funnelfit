<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForignKeyFieldsToGymStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_staff', function (Blueprint $table) {
            $table->foreignId('gym_staff_type_id')->nullable()->constrained('gym_staff_types');
            $table->foreignId('gym_location_id')->nullable()->constrained('gym_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gym_staff', function (Blueprint $table) {
            //
        });
    }
}
