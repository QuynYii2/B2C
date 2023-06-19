<?php

use App\Enums\DepositStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('address_from');
            $table->string('address_to');
            $table->float('distance');
            $table->string('weight');
            $table->string('description')->nullable();
            $table->integer('price_percent');
            $table->decimal('shipping_fee');
            $table->integer('tax_percent');
            $table->string('status')->default(DepositStatus::ACTIVE);
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
        Schema::dropIfExists('deposits');
    }
}
