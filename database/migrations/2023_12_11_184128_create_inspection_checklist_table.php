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
        Schema::create('inspection_checklist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_detail_id')->nullable();
            $table->foreign('inspection_detail_id')->references('id')->on('inspection_details');
            $table->string('name')->nullable()->default(null);
            $table->string('note')->nullable()->default(null);
            $table->boolean('good')->default(false);
            $table->boolean('repair')->default(false);
            $table->boolean('replace')->default(false);
            $table->boolean('na')->default(false);
            $table->text('images')->nullable();
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
        Schema::dropIfExists('inspection_checklist');
    }
};
