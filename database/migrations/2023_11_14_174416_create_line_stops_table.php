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
        Schema::create('LineStop', function (Blueprint $table) {
            $table->uuid('Id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->foreignuuid('LineId')
                ->constrained('Line', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignuuid('StopId')
                ->constrained('Stop', 'Id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('Order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LineStop');
    }
};
