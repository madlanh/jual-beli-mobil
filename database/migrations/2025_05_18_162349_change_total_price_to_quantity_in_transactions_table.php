<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus foreign key constraint sementara
            $table->dropForeign(['product_id']);
            
            // Ubah nama kolom dan tipe data
            $table->renameColumn('total_price', 'quantity');
            $table->unsignedInteger('quantity')->change();
            
            // Kembalikan foreign key
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            
            $table->renameColumn('quantity', 'total_price');
            $table->decimal('total_price', 10, 2)->change();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};