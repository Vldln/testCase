<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groups_id')->index();
            $table->foreignId('user_id')->index();
            $table->unsignedBigInteger('member_id')->index();
            $table->foreign('member_id')->references('id')->on('users');
            $table->boolean('status')->index();
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
        Schema::dropIfExists('requests');
    }
}
