<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateNoticeColumnInNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            if (!Schema::hasColumn('notices', 'notice_en')) {
                $table->text('notice_en')->nullable();
            }

            if (!Schema::hasColumn('notices', 'notice_ar')) {
                $table->text('notice_ar')->nullable();
            }
        });

        if (Schema::hasColumn('notices', 'notice')) {
            DB::statement('UPDATE notices SET notice_en = notice');
        }

        Schema::table('notices', function (Blueprint $table) {
            if (Schema::hasColumn('notices', 'notice')) {
                $table->dropColumn('notice');
            }
        });
    }


    public function down(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            if (!Schema::hasColumn('notices', 'notice')) {
                $table->text('notice')->nullable();
            }
        });

        if (Schema::hasColumn('notices', 'notice_en')) {
            DB::statement('UPDATE notices SET notice = notice_en');
        }

        Schema::table('notices', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('notices', 'notice_en')) {
                $columnsToDrop[] = 'notice_en';
            }

            if (Schema::hasColumn('notices', 'notice_ar')) {
                $columnsToDrop[] = 'notice_ar';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
}
