<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('quantity')->defaults(1);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_order', function(Blueprint $table)
        {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['barang_id']);
        });
        Schema::dropIfExists('barang_order');
    }
}
