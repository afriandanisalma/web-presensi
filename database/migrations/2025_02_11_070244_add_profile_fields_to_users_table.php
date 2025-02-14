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
        $table->string('photo')->nullable()->after('email');
        $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable()->after('photo');
        $table->text('address')->nullable()->after('gender');
        $table->string('phone')->nullable()->after('address');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['photo', 'gender', 'address', 'phone']);
    });
}
};
