<?php

use App\Enums\StatisticStatus;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_revenues', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->decimal('total_income');
            $table->timestamp('datetime')->default(Carbon::now()->addHours(7));
            $table->string('country')->default('vi');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('statistic_revenues');
    }
}
