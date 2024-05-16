<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('misslenouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_detail_id')->constrained('inspection_details');
            $table->string('seating_capacity')->nullable();
            $table->boolean('elect_eng_control')->default(0);
            $table->boolean('full_gause')->default(0);
            $table->boolean('wraparound')->default(0);
            $table->boolean('power_mirror')->default(0);
            $table->boolean('tilt')->default(0);
            $table->boolean('air_ride')->default(0);
            $table->boolean('restroom')->default(0);
            $table->boolean('pa_syst')->default(0);
            $table->boolean('aud_vid_syst')->default(0);
            $table->boolean('video_m_no')->default(0);
            $table->boolean('cd_charger')->default(0);
            $table->boolean('ind_aud_syst')->default(0);
            $table->boolean('gps')->default(0);
            $table->boolean('satelite_tv_syst')->default(0);
            $table->boolean('road_viewing_m_syst')->default(0);
            $table->boolean('under_floor')->default(0);
            $table->boolean('parcel_rack')->default(0);
            $table->boolean('tracon_control')->default(0);
            $table->boolean('sun_visors')->default(0);
            $table->boolean('tour_guide_seat')->default(0);
            $table->boolean('other')->default(0);
            $table->boolean('unit_driven_in')->default(0);
            $table->boolean('jump_started')->default(0);
            $table->boolean('unit_tower_in')->default(0);
            $table->boolean('unit_start_run')->default(0);
            $table->enum('unit_condition', ['good', 'bad'])->nullable();
            $table->text('not_listend_comment')->nullable();
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
        Schema::dropIfExists('misslenouses');
    }
};
