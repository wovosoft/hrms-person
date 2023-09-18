<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BdAcademicComponents\Models\AcademicBoard;
use Wovosoft\BdAcademicComponents\Models\AcademicDiscipline;
use Wovosoft\BdAcademicComponents\Models\University;
use Wovosoft\HrmsPerson\Enums\Exam;
use Wovosoft\HrmsPerson\Enums\ResultType;
use Wovosoft\HrmsPerson\Models\AcademicInformation;
use Wovosoft\HrmsPerson\Models\Person;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new AcademicInformation)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId("university_id")
                ->nullable()
                ->references('id')
                ->on((new University)->getTable())
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->enum("exam", Exam::values());
            $table->enum("result_type", ResultType::values())->nullable();
            $table->unsignedFloat("result")->nullable();
            $table->year("passing_year")->nullable();
            $table->string("session")->nullable();

            $table->foreignId("academic_board_id")
                ->nullable()
                ->references("id")
                ->on((new AcademicBoard)->getTable())
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId("academic_discipline_id")
                ->nullable()
                ->references("id")
                ->on((new AcademicDiscipline)->getTable())
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new AcademicInformation)->getTable());
    }
};
