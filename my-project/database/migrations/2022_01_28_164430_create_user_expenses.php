<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expenses_id')->index();
            $table->foreignId('user_id')->index();
            $table->unsignedBigInteger('recipient_id')->index();
            $table->unsignedBigInteger('groups_id')->index();
            $table->foreign('recipient_id')->references('id')->on('users');
            $table->integer('pay_amount');
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
        Schema::dropIfExists('transactions');
    }
}
