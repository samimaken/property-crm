<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['private-unit', 'coworking-space']);
            $table->string('unit_id');
            $table->string('tawtheeq_id');
            $table->string('sqft_size');
            $table->string('desks_allocated');
            $table->boolean('furnished')->default(0)->nullable();
            $table->double('unit_price_1');
            $table->double('unit_price_2');
            $table->double('unit_price_monthly');
            $table->double('deposit_amount');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('property_units');
    }
}
