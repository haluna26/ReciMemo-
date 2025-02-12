<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (!Schema::hasTable('recipes')) {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // name を title に変更
            $table->text('ingredients');  // food を ingredients に変更
            $table->text('instructions')->nullable();  // memo を instructions に変更
            $table->integer('value');
            $table->integer('level');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->string('description', 5000)->nullable();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
