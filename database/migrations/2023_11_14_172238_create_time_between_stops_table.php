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
        Schema::create('TimeBetweenStops', function (Blueprint $table) {
            $table->uuid('Id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->foreignuuid('FirstStopId')
                ->constrained('Stop', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignuuid('SecondStopId')
                ->constrained('Stop', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('TimeBetweenStops');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TimeBetweenStops');
    }
};
