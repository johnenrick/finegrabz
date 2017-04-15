<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ordering extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('product_order', function (Blueprint $table){
        $table->increments('id');
        $table->integer('product_id');
        $table->integer('day');
        $table->char('name', 50);
        $table->char('email', 50);
        $table->char('mobile_number', 50);
        $table->integer('rice_option');
        $table->integer('barley_option');
        $table->integer('basmati_option');
        $table->boolean('status')->comment('pending, processed, delivered');
        $table->timestamps();
        $table->SoftDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
