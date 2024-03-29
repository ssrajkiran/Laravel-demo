<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setup_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('customer_name', 100)->nullable();
            $table->string('contact_person_name', 100)->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('door_flat_no_build_name', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('road_street_name', 100)->nullable();
            $table->string('area', 100)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('email_id', 255)->nullable();
            $table->string('tin_no', 20)->nullable();
            $table->string('tan_no', 20)->nullable();
            $table->string('pan_no', 20)->nullable();
            $table->enum('service_tax_exemption', ['Yes', 'No'])->nullable();
            $table->enum('tds_percentage', ['0', '1', '2', '10'])->nullable();
            $table->tinyInteger('flag')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            // Define foreign key constraint
            $table->foreign('company_id')->references('id')->on('setup_company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_customer');
    }
};
