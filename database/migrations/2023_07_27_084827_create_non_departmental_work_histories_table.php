<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('non_departmental_work_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("institution_id");
            $table->string("designation");
            $table->string("posting_office");
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_departmental_work_histories');
    }
};
