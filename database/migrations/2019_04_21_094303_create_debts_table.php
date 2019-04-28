<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('payer_id');
            $table->unsignedBigInteger('money');
            $table->boolean('completed')->default(false);
            $table->string('description');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->ondelete('cascsade');
            $table->foreign('payer_id')->references('id')->on('users')->ondelete('cascsade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debts');
    }
}
