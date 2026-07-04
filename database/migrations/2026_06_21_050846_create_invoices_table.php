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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('invoice_no')->unique();
            $table->decimal('amount', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->string('student_name');
            $table->string('course_name');
            $table->date('due_date')->nullable();
            $table->enum('status', [
                'unpaid',
                'partial',
                'paid',
                'cancelled'
            ])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
