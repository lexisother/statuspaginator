<?php

use App\Models\Site;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Site::class)->index()->nullable();
        });

        // Bring down the permission tables as we do not need them anymore.
//        $baseDir = database_path('migrations');
//        $permsMigration = require_once "$baseDir/2023_11_01_150523_create_permission_tables.php";
//        $permsMigration->down();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('site_id')->index();
        });

//        $baseDir = database_path('migrations');
//        $permsMigration = require_once "$baseDir/2023_11_01_150523_create_permission_tables.php";
//        $permsMigration->up();
    }
};
