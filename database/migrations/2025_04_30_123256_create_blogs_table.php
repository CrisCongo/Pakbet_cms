<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('blogID');
            $table->string('title');
            $table->string('category');
            $table->string('tags')->nullable(); //comma-separated
            $table->string('cover_image')->nullable();
            $table->longText('content');
            $table->dateTime('publish_date')->nullable();
            $table->enum('status', ['draft', 'archive', 'published'])->default('draft');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
}
