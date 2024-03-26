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
        Schema::create('merchandise_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('merchandise_id')->constrained('merchandises')->onDelete('cascade');
            $table->float('merchandise_price', 255);
            $table->unsignedBigInteger('merchandise_quantity')->default(1);
            $table->string('address_province');
            $table->string('address_city');
            $table->string('address_detail');
            $table->string('phone');
            $table->string('email');
            $table->float('shipping_cost', 255);
            $table->float('payment_total', 255);
            $table->string('snap_token')->nullable();
            $table->enum('payment_status', ['1', '2', '3'])->comment('1=pending, 2=paid, 3=cancel')->default(1);
            $table->string('payment_method')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandise_transactions');
    }
};
