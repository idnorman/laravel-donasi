<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id')->unique();
            $table->foreignIdFor(\App\Models\Program::class, 'program_id');
            $table->foreignIdFor(\App\Models\User::class, 'donatur_id');
            $table->smallInteger('is_hide_name')->default(0);
            $table->float('amount', 255)->default(0);
            $table->enum('payment_status', ['1', '2', '3'])->comment('1=pending, 2=paid, 3=cancel')->default(1);
            $table->string('payment_method')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
