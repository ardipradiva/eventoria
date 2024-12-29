<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('payment_methods', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key untuk user
        $table->string('payment_method'); // Debit atau E-Wallet
        $table->string('account_number')->nullable(); // Nomor rekening (hanya untuk Debit)
        $table->string('phone_number')->nullable(); // Nomor telepon (hanya untuk E-Wallet)
        $table->string('bank_name')->nullable(); // Nama bank (hanya untuk Debit)
        $table->string('e_wallet_name')->nullable(); // Nama E-Wallet (hanya untuk E-Wallet)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};