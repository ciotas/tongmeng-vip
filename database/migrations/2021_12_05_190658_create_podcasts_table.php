<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('market')->nullable()->comment('市场');
            $table->unsignedInteger('exchange_id')->nullable()->comment('标的');
            $table->foreign('exchange_id')->references('id')->on('exchanges')->onDelete('cascade');
            $table->decimal('price', 16, 8)->nullable()->comment('质变线');
            $table->string('period')->nullable()->comment('周期数列');
            $table->string('image')->nullable()->comment('行情图');
            $table->text('tips')->nullable()->comment('行情提示');
            $table->unsignedInteger('status')->default(0)->nullable()->comment('状态');
            $table->unsignedInteger('online')->default(1)->nullable()->comment('上线');
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
        Schema::dropIfExists('podcasts');
    }
}
