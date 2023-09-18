<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\HrmsPerson\Enums\AddressType;
use Wovosoft\HrmsPerson\Models\Person;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("person_id")
                ->references('id')
                ->on((new Person)->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum("type", AddressType::values());

            /**
             * NOTE: Foreign key not allowed in different connections/databases
             */
            $table->foreignId('division_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('upazila_id')->nullable();

            $table->string('thana')->nullable();
            $table->string('bn_thana')->nullable();

            $table->foreignId('union_id')->nullable();


            $table->string('post_office')->nullable();

            $table->string('village')->nullable();
            $table->string('bn_village')->nullable();
            $table->string('word')->nullable();
            $table->string('bn_word')->nullable();
            $table->string('road')->nullable();
            $table->string('bn_road')->nullable();
            $table->string('house')->nullable();
            $table->string('bn_house')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
