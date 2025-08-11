<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tdtask10', function (Blueprint $table) {
            $table->unsignedInteger('TASK10_ID')->autoIncrement()->comment('Task ID');
            $table->string('TASK10_TITL', 128)->comment('Task Title');
            $table->text('TASK10_DESC')->nullable()->comment('Task Description');
            $table->integer('TASK10_STUS')->comment('Task Status');
            $table->dateTime('TASK10_DUED')->comment('Task Due Date');
            $table->dateTime('TASK10_CRTD')->comment('Created DateTime');
            $table->unsignedInteger('TASK10_CRTU')->comment('Created User');
            $table->string('TASK10_CRTP', 128)->default('Manual Insert')->comment('Created Program');
            $table->dateTime('TASK10_LUPD')->comment('Last Updated DataTime');
            $table->unsignedInteger('TASK10_LUPU')->comment('Last Updated User');
            $table->string('TASK10_LUPP', 128)->default('Manual Insert')->comment('Last Updated Program');
            $table->unsignedInteger('TASK10_DFLG')->default(0)->comment('Delete Flag');
            
            $table->primary('TASK10_ID');
        });

        // Add the table comment and set the engine/collation if needed
        DB::statement("ALTER TABLE tdtask10 COMMENT = 'Task table'");
        DB::statement("ALTER TABLE tdtask10 ENGINE = MyISAM");
        DB::statement("ALTER TABLE tdtask10 COLLATE = 'utf8mb4_general_ci'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tdtask10');
    }
};