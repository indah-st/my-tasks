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
    Schema::create('tasks_history', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('task_id');
        $table->unsignedBigInteger('user_id');  // Menambahkan user_id
        $table->string('action');  // Aksi yang dilakukan (misal: add, edit, delete)
        $table->timestamps();

        // Relasi dengan tabel task dan user
        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

};