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
        Schema::create('setup_region', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('region_name');
            $table->string('region_code');
            $table->string('invoice_code');
            $table->tinyInteger('flag')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            // Define foreign key constraints
            $table->foreign('company_id')->references('id')->on('setup_company');
            $table->foreign('division_id')->references('id')->on('setup_division');
            $table->foreign('unit_id')->references('id')->on('setup_units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_region');
    }
};
