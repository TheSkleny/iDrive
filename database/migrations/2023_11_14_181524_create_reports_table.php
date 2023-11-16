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
        Schema::create('Report', function (Blueprint $table) {
            $table->uuid('Id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->date('ReportDate');
            $table->foreignid('DriverId')
                ->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('DriverDescription');
            $table->foreignuuid('VehicleId')
                ->constrained('Vehicle', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignid('TechnicianId')
                ->constrained('users', 'id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('TechnicianDescription');
            $table->date('MaintenanceDate')->nullable();
            $table->foreignid('StateId')
                ->constrained('ReportState', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignid('TypeId')
                ->constrained('ReportType', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Report');
    }
};
