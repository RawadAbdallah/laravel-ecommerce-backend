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
        Schema::create('user_types', function (Blueprint $table) {
            $table->id('id_user_type');
            $table->string('user_type', 16);
            $table->timestamps();
        });

        DB::table('user_types')->insert(
            [
                ['user_type' => 'admin'],
                ['user_type' => 'seller'],
                ['user_type' => 'customer'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_types');
    }
};
