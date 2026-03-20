<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('email');
            $table->string('motto')->nullable()->after('address');
            $table->integer('age')->nullable()->after('motto');
            $table->enum('sex', ['male', 'female', 'other'])->nullable()->after('age');
            $table->string('profile_photo')->nullable()->after('sex');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'motto', 'age', 'sex', 'profile_photo']);
        });
    }
};