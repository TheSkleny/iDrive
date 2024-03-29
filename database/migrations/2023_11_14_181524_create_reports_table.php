<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->foreignuuid('SubmitterId')
                ->constrained('users', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('Description');
            $table->foreignuuid('VehicleId')
                ->nullable()
                ->constrained('Vehicle', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignuuid('TechnicianId')
                ->nullable()
                ->constrained('users', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('TechnicianDescription')
                ->nullable();
            $table->date('MaintenanceDate')
                ->nullable();
            // enum
            $table->foreignid('StateId')
                ->constrained('ReportState', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // enum
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
