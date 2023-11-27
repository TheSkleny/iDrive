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
        Schema::create('Link', function (Blueprint $table) {
            $table->uuid('Id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->foreignuuid('LineId')
                ->constrained('Line', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignuuid('VehicleId')
                ->nullable()
                ->constrained('Vehicle', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignuuid('DriverId')
                ->nullable()
                ->constrained('users', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->dateTime('DepartureDate');
            $table->boolean('IsReverse');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Link');
    }
};
