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
    Schema::table('products', function (Blueprint $table) {
        // hapus user_id
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');

        // tambah seller_id
        $table->foreignId('seller_id')
              ->constrained('users')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['seller_id']);
        $table->dropColumn('seller_id');

        $table->foreignId('user_id')
              ->constrained()
              ->onDelete('cascade');
    });
}

};
