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
        Schema::create('Vehicle', function (Blueprint $table) {
            $table->uuid('Id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('Name')->nullable()->unique();
            $table->string('Brand');
            $table->string('ImageUri')->nullable();
            $table->date('LastMaintenance');
            $table->integer('Capacity');
            $table->integer('SpeedLimit');
            $table->string('LicensePlate');
            $table->foreignId('TypeId')
                ->constrained('VehicleType', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('StateId')
                ->constrained('VehicleState', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Vehicle');
    }
};
