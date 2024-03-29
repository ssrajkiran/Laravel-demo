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
        Schema::create('setup_po', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('project_site')->nullable();
            $table->string('po_number')->nullable();
            $table->string('po_date')->nullable();
            $table->decimal('po_value', 10, 2)->nullable();
            $table->decimal('consumed', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->tinyInteger('flag')->default(1);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->foreign('division_id')->references('id')->on('setup_division');
            $table->foreign('unit_id')->references('id')->on('setup_units');
            $table->foreign('region_id')->references('id')->on('setup_region');
            $table->foreign('customer_id')->references('id')->on('setup_customer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_po');
    }
};
