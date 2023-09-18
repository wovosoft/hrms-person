<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Enums\Countries;
use Wovosoft\HrmsPerson\Enums\IdentificationType;
use Wovosoft\HrmsPerson\Models\Person;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('identifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum("type", IdentificationType::values());
            $table->string("number");
            $table->date("issue_date")->nullable();
            $table->date("expiry_date")->nullable();
            $table->enum("issuing_country", Countries::values())->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identifications');
    }
};
