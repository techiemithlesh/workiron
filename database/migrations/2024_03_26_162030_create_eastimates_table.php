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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_detail_id')->constrained('inspection_details');
            $table->string('item_name')->nullable();
            $table->text('desciption')->nullable();
            $table->integer('item_cost')->nullable();
            $table->integer('labor_cost')->nullable();
            $table->integer('t_part_cost')->nullable();
            $table->integer('t_labor_cost')->nullable();
            $table->mediumText('comments')->nullable();
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
        Schema::dropIfExists('estimates');
    }
};
