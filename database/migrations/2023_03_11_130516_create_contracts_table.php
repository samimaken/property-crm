<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('contract_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('second_payment_date')->nullable();
            $table->double('initial_percentage')->nullable();
            $table->double('security_deposit');
            $table->double('vat');
            $table->double('total_amount');
            $table->double('grand_amount');
            $table->double('no_of_years')->nullable();
            $table->double('no_of_months')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('company_name');
            $table->string('representative');
            $table->string('designation');
            $table->string('date');
            $table->string('status');
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
        Schema::dropIfExists('contracts');
    }
}
