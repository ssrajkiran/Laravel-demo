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
        Schema::create('setup_engineer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('region_id');
            $table->string('person_role')->nullable();
            $table->string('engineer_ecode')->nullable();
            $table->string('engineer_name')->nullable();
            $table->string('engineer_designation')->nullable();
            $table->string('email_id')->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->string('doj')->nullable();
            $table->string('dop')->nullable();
            $table->string('experience')->nullable();
            $table->integer('yocc')->nullable();
            $table->decimal('eligible_allowance', 10, 2)->nullable();
            $table->decimal('perday_allowance', 10, 2)->nullable();
            $table->string('bank_name');
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->tinyInteger('flag')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            // Define foreign key constraints
            $table->foreign('company_id')->references('id')->on('setup_company');
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
        Schema::dropIfExists('setup_engineer');
    }
};
