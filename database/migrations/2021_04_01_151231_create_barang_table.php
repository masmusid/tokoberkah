<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('nama');
            $table->string('cover')->nullable();
            $table->string('slug');
            $table->text('deskripsi');
            $table->float('harga');
            $table->float('harga_supplier');
            $table->integer('qty')->default(0)->unsigned();
            $table->string('satuan');
            $table->date('exp_date');
            $table->integer('views')->default(0)->unsigned();
            $table->enum('status', ['PUBLISH','DRAFT']);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();    
            
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}