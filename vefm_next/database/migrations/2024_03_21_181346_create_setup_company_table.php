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
        Schema::create('setup_company', function (Blueprint $table) {
            $table->id();
            $table->string('company_code')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('website')->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('flag')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_company');
    }
};
