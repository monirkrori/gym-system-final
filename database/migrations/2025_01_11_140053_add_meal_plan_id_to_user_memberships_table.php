<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMealPlanIdToUserMembershipsTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::table('user_memberships', function (Blueprint $table) {
$table->unsignedBigInteger('meal_plan_id')->nullable()->after('id'); // يمكنك اختيار العمود السابق باستخدام after()
$table->foreign('meal_plan_id')->references('id')->on('meal_plans')->onDelete('cascade');
});
}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::table('user_memberships', function (Blueprint $table) {
$table->dropForeign(['meal_plan_id']); // حذف المفتاح الأجنبي
$table->dropColumn('meal_plan_id');    // حذف العمود
});
}
}
