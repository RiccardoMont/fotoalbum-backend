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
        Schema::table('photos', function (Blueprint $table) {
            
            $table->unsignedBigInteger('best_shoot_id')->nullable()->after('id');

            $table->foreign('best_shoot_id')
            ->references('id')
            ->on('best_shoots')
            ->nullOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            
            $table->dropForeign('photos_best_shoot_id_foreign');

            $table->dropColumn('best_shoot_id');

        });
    }
};
