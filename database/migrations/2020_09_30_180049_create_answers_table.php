<?php

use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAnswersTable
 */
class CreateAnswersTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->boolean('correct')->default(false);
            $table->foreignIdFor(Question::class);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
}
