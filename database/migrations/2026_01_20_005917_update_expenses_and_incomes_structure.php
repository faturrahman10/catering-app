<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['category', 'description', 'amount']);

            // Tambah kolom baru
            $table->json('items')->after('id'); // Menyimpan array items
            $table->integer('total_amount')->after('items'); // Total dari semua items
        });

        Schema::table('incomes', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['source', 'description', 'amount']);

            // Tambah kolom baru
            $table->json('items')->after('id'); // Menyimpan array items
            $table->integer('total_amount')->after('items'); // Total dari semua items
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn(['items', 'total_amount']);
            $table->string('category');
            $table->text('description');
            $table->integer('amount');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn(['items', 'total_amount']);
            $table->string('source');
            $table->text('description');
            $table->integer('amount');
        });
    }
};
