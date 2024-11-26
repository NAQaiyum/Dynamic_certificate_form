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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('ex_name');
            $table->string('ex_address')->nullable();
            $table->string('con_name')->nullable();
            $table->string('con_full_address')->nullable();
            $table->string('con_country')->nullable();
            $table->date('dep_date')->nullable();
            $table->string('vessels_name')->nullable();
            $table->string('port_of_discharge')->nullable();
            $table->string('country_destination')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('certificate_origin_no')->nullable();
            $table->string('signature_1')->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_1')->nullable();
            $table->string('h_s_code')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->string('signature_2')->nullable();
            $table->date('date_2')->nullable();
            $table->string('serialno')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
