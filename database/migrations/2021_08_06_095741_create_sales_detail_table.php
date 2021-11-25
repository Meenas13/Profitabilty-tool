<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sale')->unsigned();
           // $table->foreign('id_sale')->references('id')->on('sales')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 11, 2); 
            $table->decimal('discount', 11, 2); 
            $table->decimal('total', 11, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_detail');
    }
}
