<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tduser10', function (Blueprint $table) {
            $table->integer('USER10_ID')->autoIncrement()->comment('User ID');
            $table->string('USER10_NAME', 64)->nullable()->comment('Username');
            $table->string('USER10_EMAL', 64)->nullable()->comment('User Email');
            $table->dateTime('USER10_CRTD')->comment('Created DateTime');
            $table->unsignedInteger('USER10_CRTU')->comment('Created User');
            $table->string('USER10_CRTP', 128)->default('Manual Insert')->comment('Created Program');
            $table->dateTime('USER10_LUPD')->comment('Last Updated DataTime');
            $table->unsignedInteger('USER10_LUPU')->comment('Last Updated User');
            $table->string('USER10_LUPP', 128)->default('Manual Insert')->comment('Last Updated Program');
            $table->unsignedInteger('USER10_DFLG')->default(0)->comment('Delete Flag');
            
            $table->primary('USER10_ID');
        });

        // Add table options that aren't available through Schema builder
        DB::statement("ALTER TABLE tduser10 COMMENT = 'User table'");
        DB::statement("ALTER TABLE tduser10 ENGINE = MyISAM");
        DB::statement("ALTER TABLE tduser10 COLLATE = 'utf8mb4_general_ci'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tduser10');
    }
};