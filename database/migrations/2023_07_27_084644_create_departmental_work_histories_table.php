<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BkbHrmsCore\Models\Designation;
use Wovosoft\BkbOffices\Models\Office;
use Wovosoft\HrmsPerson\Models\WorkHistory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departmental_work_histories', function (Blueprint $table) {
            $table->id();

            /**
             * Note: Foreign ID Reference not allowed
             */
            $table->foreignId("office_id")->nullable();

            $table->foreignId("designation_id")
                ->nullable()
                ->references('id')
                ->on((new Designation)->getTable())
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departmental_work_histories');
    }
};
