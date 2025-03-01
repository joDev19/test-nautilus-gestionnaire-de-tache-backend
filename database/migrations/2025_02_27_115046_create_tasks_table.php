<?php

use App\Consts;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('title');
            $table->date('end_date')->nullable();
            $table->enum('status', [Consts::$STATUS_EN_ATTENTE, Consts::$STATUS_EN_COURS, Consts::$STATUS_TERMINE])->default(Consts::$STATUS_EN_ATTENTE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
