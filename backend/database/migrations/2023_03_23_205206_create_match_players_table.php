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
        Schema::create('match_players', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\MatchDay::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->boolean('confirmed')->default(false)
                ->comment('the confirmation is given by the user');

            $table->unique(['user_id', 'match_day_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_players');
    }
};
