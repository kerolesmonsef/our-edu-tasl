<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
    "paidAmount":150,
    "Currency":"SAR",
    "parentEmail":"parent1@parent.eu",
    "statusCode":2,
    "paymentDate": "2021-10-6",
    "parentIdentification": "d3d29d70-1d66-11e3-8591-034165a3a613"
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('paidAmount', 8, 2);
            $table->string('currency');
            $table->string('parentEmail');
            $table->unsignedTinyInteger('statusCode');
            $table->date('paymentDate');
            $table->string('parentIdentification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
