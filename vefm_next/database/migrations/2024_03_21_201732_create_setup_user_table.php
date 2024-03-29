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
        Schema::create('setup_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('region_id');
            $table->string('name');
            $table->string('personrole');
            $table->string('user_id');
            $table->string('password');
            $table->string('hash_password');
            $table->enum('status', ['active', 'pause'])->nullable();
            $table->string('designation');
            $table->string('email_id');
            $table->string('mobile_number');
            $table->tinyInteger('flag')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            // Define foreign key constraints
            $table->foreign('division_id')->references('id')->on('setup_division');
            $table->foreign('unit_id')->references('id')->on('setup_units');
            $table->foreign('region_id')->references('id')->on('setup_region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup_user');
    }
};
