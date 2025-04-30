<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsperGuidesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prosper_guides', function (Blueprint $table) {
            $table->enum('zodiacID', [
                'Rat', 'Ox', 'Tiger', 'Rabbit', 'Dragon', 'Snake',
                'Horse', 'Goat', 'Monkey', 'Rooster', 'Dog', 'Pig'
            ])->primary(); // zodiacID as primary key
            $table->longText('overview');
            $table->longText('career');
            $table->longText('health');
            $table->longText('love');
            $table->longText('wealth');
            $table->dateTime('publish_date')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prosper_guides');
    }
}
