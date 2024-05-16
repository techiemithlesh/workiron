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
        Schema::create('inspection_in_cabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_detail_id')->constrained('inspection_details');
            $table->string('condition_name')->nullable();
            $table->enum('status', ['OK', 'Bad', 'Good', 'N/A'])->nullable();
            $table->longText('operational_img')->nullable();
            $table->text('condition_comments')->nullable();
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
        Schema::dropIfExists('inspection_in_cabs');
    }
};
