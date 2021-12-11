<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaxLossToAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->decimal('crpto_max_loss')->default(0)->nullable()->after('points')->comment('数字货币最大可承受损失');
            $table->decimal('a_stock_max_loss')->default(0)->nullable()->after('crpto_max_loss')->comment('A股最大可承受损失');
            $table->decimal('hk_stock_max_loss')->default(0)->nullable()->after('a_stock_max_loss')->comment('港股最大可承受损失');
            $table->decimal('us_stock_max_loss')->default(0)->nullable()->after('hk_stock_max_loss')->comment('美股最大可承受损失');
            $table->decimal('fc_stock_max_loss')->default(0)->nullable()->after('us_stock_max_loss')->comment('外汇最大可承受损失');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //
        });
    }
}
