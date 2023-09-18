<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Enums\ContactType;
use Wovosoft\HrmsPerson\Models\Contact;
use Wovosoft\HrmsPerson\Models\Person;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new Contact)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum('type', ContactType::values());
            $table->string('content');

            $table->string('label')->nullable();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('relation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new Contact)->getTable());
    }
};
