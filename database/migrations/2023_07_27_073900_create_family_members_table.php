<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Enums\Relation;
use Wovosoft\HrmsPerson\Models\FamilyMember;
use Wovosoft\HrmsPerson\Models\Person;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new FamilyMember)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum("relation", Relation::values());

            $table->foreignId("related_person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new FamilyMember)->getTable());
    }
};
