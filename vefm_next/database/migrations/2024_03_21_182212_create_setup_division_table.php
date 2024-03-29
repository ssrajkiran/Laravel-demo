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
        Schema::create('setup_division', function (Blueprint $table) {
            $table->id();
            $table->string('division_name', 50)->nullable();
            $table->string('division_code', 50)->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->tinyInteger('flag')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->foreign('company_id')->references('id')->on('setup_company')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_division');
    }
};
