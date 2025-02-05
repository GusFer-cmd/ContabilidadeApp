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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('renter_id');
            $table->unsignedBigInteger('card_id');
            $table->timestamp('payment_date');
            $table->decimal('payment_value', 10, 2)->default(0);

            $table->timestamps();

            $table->foreign('renter_id')->references('id')->on('renters');
            $table->foreign('card_id')->references('id')->on('cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};
