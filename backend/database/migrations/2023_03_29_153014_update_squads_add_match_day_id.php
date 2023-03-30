<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'squads';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table( $this->table, function( Blueprint $table ) {
            $table->foreignIdFor(\App\Models\MatchDay::class)
                ->after('id')
                ->comment('match day id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table( $this->table, function( Blueprint $table ) {
            $table->removeColumn('');
        });
    }
};
