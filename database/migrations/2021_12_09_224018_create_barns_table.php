<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('market')->nullable()->comment('市场');
            $table->unsignedInteger('exchange_id')->nullable()->comment('标的');
            $table->foreign('exchange_id')->references('id')->on('exchanges')->onDelete('cascade');
            $table->string('period')->nullable()->comment('周期数列');
            $table->decimal('buy_price',16, 8)->default('0')->nullable()->comment('挂单价');
            $table->decimal('stoploss_price', 16, 8)->default('0')->nullable()->comment('止损价');
            $table->decimal('real_amount', 20 ,8)->default('0')->nullable()->comment('实际仓位');
            $table->string('images')->nullable()->nullable()->comment('分析截图');
            $table->unsignedBigInteger('admin_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barns');
    }
}
