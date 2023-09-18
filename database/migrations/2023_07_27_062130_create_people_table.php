<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Enums\BloodGroup;
use Wovosoft\HrmsPerson\Enums\Gender;
use Wovosoft\HrmsPerson\Enums\MaritalStatus;
use Wovosoft\HrmsPerson\Enums\Religion;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("bn_name")->nullable();
            $table->date('dob')->nullable();
            $table->enum("gender", Gender::values())->nullable();
            $table->enum("religion", Religion::values())->nullable();
            $table->enum("marital_status", MaritalStatus::values())->nullable();
            $table->enum("blood_group", BloodGroup::values())->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
