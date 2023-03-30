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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->comment('user that owns this card');
            $table->enum('primary_position', \App\Models\Concerns\Position::values())->default(\App\Models\Concerns\Position::MIDFIELD->value)
                ->comment('main player position');
            $table->enum('secondary_position', \App\Models\Concerns\Position::values())->default(\App\Models\Concerns\Position::STRIKER->value)
                ->comment('a backup position');

            $table->unsignedTinyInteger('pass')->default(1)
                ->comment('ball passing, from 1 to 5');
            $table->unsignedTinyInteger('shoot')->default(1)
                ->comment('shooting force and precision, from 1 to 5');
            $table->unsignedTinyInteger('speed')->default(1)
                ->comment('from 1 to 5');
            $table->unsignedTinyInteger('stamina')->default(1)
                ->comment('player resistance, from 1 to 5');
            $table->unsignedTinyInteger('dribble')->default(1)
                ->comment('player ability, from 1 to 5');
            $table->unsignedTinyInteger('overall')->default(1)
                ->comment('general player abilities, from 1 to 5');
            $table->enum('status', \App\Models\Enums\UserStatus::values())->default(\App\Models\Enums\UserStatus::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
