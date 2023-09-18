<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Enums\WorkHistoryType;
use Wovosoft\HrmsPerson\Models\Person;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum('type', WorkHistoryType::values())->nullable();

            $table->date("from")->nullable();
            $table->date("to")->nullable();

            $table->boolean("is_departmental")->default(true);

            $table->foreignId("prev_work_history_id")
                ->nullable()
                ->references('id')
                ->on('work_histories')
                ->cascadeOnUpdate();

            $table->nullableMorphs("info");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_histories');
    }
};
