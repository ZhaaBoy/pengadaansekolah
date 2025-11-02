<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['staff', 'vendor', 'kepala_sekolah'])->default('staff')->after('password');
        });
    }
    public function down()
    {
        Schema::table('users', fn($t) => $t->dropColumn('role'));
    }
};
