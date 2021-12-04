<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('market')->nullable()->comment('交易所');
            $table->string('symbol')->index()->nullable()->comment('交易对');
            $table->string('pair')->index()->nullable()->comment('标的交易对');
            $table->string('quoteAsset')->nullable()->comment('报价资产');
            $table->string('baseAsset')->nullable()->comment('标的资产');
            // $table->decimal('maxQty',12,2)->default('0')->nullable()->comment('数量上限');
            // $table->decimal('minQty')->default('0')->nullable()->comment('数量下限');
            // $table->decimal('stepSize')->default('0')->nullable()->comment('订单最小数量间隔');
            // $table->decimal('minPrice')->default('0')->nullable()->comment('价格下限');
            // $table->decimal('maxPrice')->default('0')->nullable()->comment('价格上限');
            // $table->decimal('tickSize')->nullable()->comment('订单最小价格间隔');
            $table->unsignedInteger('pricePrecision')->default('0')->nullable()->comment('价格小数点位数');
            $table->unsignedInteger('quantityPrecision')->default('0')->nullable()->comment('数量小数点位数');

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
        Schema::dropIfExists('exchanges');
    }

}
