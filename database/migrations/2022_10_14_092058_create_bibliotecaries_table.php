<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibliotecaries', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('user_id')->unsigned();
          $table->bigInteger('contact');
          $table->string('address');
          $table->string('nacionality');
          $table->string('profession');
          $table->string('company');
          $table->timestamps();


          $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bibliotecaries');
    }
};
