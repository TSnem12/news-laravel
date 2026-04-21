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
            $table->text('notice_en')->nullable();
            $table->text('notice_ar')->nullable();
        });

        DB::statement('UPDATE notices SET notice_en = notice');

        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('notice');
        });
    }

    public function down(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->text('notice')->nullable();
        });

        DB::statement('UPDATE notices SET notice = notice_en');

        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn(['notice_en', 'notice_ar']);
        });
    }
}
