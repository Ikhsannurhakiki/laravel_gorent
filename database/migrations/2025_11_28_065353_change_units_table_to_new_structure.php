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
        Schema::table('units', function (Blueprint $table) {


            // Step 2b: Tambah kolom type sebagai foreignId
            $table->foreignId('type')
                ->default(1) // default harus dulu
                ->constrained('unit_types')
                ->after('business_id');

            // 3. Tambah kolom location
            $table->string('location_name')->nullable()->after('description');
            $table->decimal('latitude', 10, 7)->nullable()->after('location_name');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            // 1. Hapus kolom location
            $table->dropColumn(['location_name', 'latitude', 'longitude']);

            // 2. Kembalikan type menjadi string
            $table->dropForeign(['type']);
            $table->string('type')->nullable()->change();
        });
    }
};
