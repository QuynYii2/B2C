<?php

use App\Enums\StatisticStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticOrderSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_order_searches', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('statistic_order');
            $table->integer('statistic_search');
            $table->string('service');
            $table->string('status')->default(StatisticStatus::ACTIVE);
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
        Schema::dropIfExists('statistic_order_searches');
    }
}
