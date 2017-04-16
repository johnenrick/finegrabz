<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('products', function (Blueprint $table) {
          $table->increments('id');
          $table->char('description', 100);
          $table->tinyInteger('day');
          $table->text('details');
          $table->double('rice', 15, 8);
          $table->double('barley', 15, 8);
          $table->double('basmati_rice', 15, 8);
          $table->text('image');
          $table->boolean('status');
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
