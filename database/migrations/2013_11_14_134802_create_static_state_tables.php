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
        Schema::create('VehicleState', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Description');
        });

        Schema::create('VehicleType', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Description');
        });

        Schema::create('UserType', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Description');
        });

        Schema::create('ReportState', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Description');
        });

        Schema::create('ReportType', function (Blueprint $table) {
            $table->id('Id');
            $table->string('Description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('VehicleState');
        Schema::dropIfExists('VehicleType');
        Schema::dropIfExists('UserType');
        Schema::dropIfExists('ReportState');
        Schema::dropIfExists('ReportType');
    }
};
