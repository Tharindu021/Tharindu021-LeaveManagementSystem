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
        Schema::create('leave_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason')->nullable();
            $table->bigInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_data');
    }
};
