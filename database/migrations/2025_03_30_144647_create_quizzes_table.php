<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('question')->nullable();
            $table->enum('type', ['pg_text', 'essay_text', 'pg_audio', 'essay_audio']);
            $table->json('options')->nullable(); // Untuk PG, simpan dalam format JSON
            $table->string('correct_answer')->nullable();
            $table->string('audio_path')->nullable(); // Jika soal audio
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};

