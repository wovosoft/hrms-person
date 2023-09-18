<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Models\Person;
use Wovosoft\HrmsPerson\Models\PersonPhoto;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new PersonPhoto)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references("id")
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId("uploader_id")
                ->nullable()
                ->references("id")
                ->on((new User)->getTable())
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string("disk")->nullable();
            $table->string("path");
            $table->timestamps();
        });

        Schema::table((new Person)->getTable(), function (Blueprint $table) {
            $table
                ->foreignId("person_photo_id")
                ->after("id")
                ->nullable()
                ->references("id")
                ->on((new PersonPhoto)->getTable())
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new PersonPhoto)->getTable());
        Schema::table((new Person)->getTable(), function (Blueprint $table) {
            $table->dropColumn("person_photo_id");
        });
    }
};
