<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('reminder_id')->index()->nullable()->comment('提醒');
            $table->foreign('reminder_id')->references('id')->on('reminders')->onDelete('cascade');
            $table->decimal('price')->index()->default('0')->nullable()->comment('提醒价格');
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
        Schema::dropIfExists('reminder_records');
    }
}
