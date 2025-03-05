<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->uuid('unique_id')->default(DB::raw('UUID()')); // UUID with default
            $table->string('title', 200); // VARCHAR(200)
            $table->text('content'); // TEXT column
            $table->timestamp('created_at')->useCurrent(); // Default to now()
            $table->string('author', 200)->nullable(); // VARCHAR(200), nullable
            $table->string('category', 100)->nullable(); // VARCHAR(100), nullable
            $table->timestamp('updated_at')->nullable(); // Nullable timestamp
            $table->integer('likes_count')->default(0); // Integer, default 0
            $table->integer('author_id')->nullable(); // Nullable integer
            $table->boolean('is_published')->default(false); // Boolean, default false
            $table->integer('views')->default(0); // Integer, default 0
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
