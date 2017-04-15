<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productoption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('products', function (Blueprint $table){
        $table->dropColumn('price');
        $table->double('rice', 15, 8)->after('details');
        $table->double('barley', 15, 8)->after('rice');
        $table->double('Basmati Rice', 15, 8)->after('barley');
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
