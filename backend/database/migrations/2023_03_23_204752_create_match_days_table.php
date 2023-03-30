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
        Schema::create('match_days', function (Blueprint $table) {
            $table->id();
            $table->dateTime('when')
                ->comment('the scheduled date of match');
            $table->string('where', 200 )
                ->comment('the address of the match');
            $table->string('observations', 512)->nullable()
                ->comment('additional info about the match');

            $table->enum('status', \App\Models\Enums\DefaultStatus::values())->default(\App\Models\Enums\DefaultStatus::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_days');
    }
};
