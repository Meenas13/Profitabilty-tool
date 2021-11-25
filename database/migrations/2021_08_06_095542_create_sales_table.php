<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
           // $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('add_by');
            //$table->foreign('add_by')->references('id')->on('users');
            $table->integer('update_by')->nullable();
            //$table->foreign('update_by')->references('id')->on('users');
            $table->dateTime('date');
            $table->integer('bill_no')->nullable();
            $table->decimal('tax', 4, 2);
            $table->decimal('total', 11, 2);
            $table->decimal('paid', 11, 2);
            $table->decimal('due', 11, 2);
            $table->decimal('discount', 11, 2);
            $table->text('comment');
            $table->boolean('status', 1);
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
        Schema::dropIfExists('sales');
    }
}
