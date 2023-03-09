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
        Schema::create('todo_tasks', function (Blueprint $table) {
            $table->id();
						$table->String('label');
						$table->boolean('completed')->default(false);
						$table->foreign('todo_id')
							->references('id')
							->on('todos')
							->onUpdate('CASCADE')
							->onDelete('CASCADE');
						$table->unsignedBigInteger('todo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_tasks');
    }
};