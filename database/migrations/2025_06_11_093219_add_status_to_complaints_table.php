<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // إضافة عمود 'status' من نوع string بقيمة افتراضية 'pending'
            $table->string('status')->default('pending')->after('details');
            // '.after('details')' هو اختياري ويحدد موقع العمود بعد عمود 'details'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // حذف عمود 'status' عند التراجع عن الـ Migration
            $table->dropColumn('status');
        });
    }
};