<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('market')->index()->nullable();
            $table->unsignedInteger('exchange_id')->index()->nullable()->comment('交易所');
            $table->foreign('exchange_id')->references('id')->on('exchanges')->onDelete('cascade');
            $table->string('peroid')->nullable()->comment('周期');
            $table->decimal('price',16, 8)->default('0')->nullable()->comment('提醒价格');
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
        Schema::dropIfExists('reminders');
    }
}
