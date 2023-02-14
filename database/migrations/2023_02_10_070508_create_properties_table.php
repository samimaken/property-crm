<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->text('address');
            $table->date('pma_contract_start_date');
            $table->date('pma_contract_end_date');
            $table->double('aed_value');
            $table->double('sqft_size');
            $table->boolean('meeting_room')->default(0);
            $table->boolean('conference_room')->default(0);
            $table->boolean('fully_furnished')->default(0);
            $table->string('pma_agreement');
            $table->string('lat');
            $table->string('lng');
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
        Schema::dropIfExists('properties');
    }
}
