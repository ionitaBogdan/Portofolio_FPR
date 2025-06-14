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
        Schema::create('action_lists', function (Blueprint $table) {
            $table->id();
            $table->date('date_raised');
            $table->text('improvements');
            $table->string('location');
            $table->string('manager');
            $table->string('title');
            $table->string('status')->default('Open');
            $table->date('date_complete')->nullable();
            $table->date('due_date')->nullable();
            $table->text('comment')->nullable();
            $table->string('comment_img')->nullable();
            $table->text('activity_transport')->nullable();
            $table->text('activity_inv')->nullable();
            $table->text('activity_motion')->nullable();
            $table->text('activity_waiting')->nullable();
            $table->text('activity_overprocess')->nullable();
            $table->text('activity_overproduct')->nullable();
            $table->text('activity_defect')->nullable();
            $table->text('activity_skills')->nullable();
            $table->foreignId('gemba_id')->constrained('gembas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_lists');
    }
};
