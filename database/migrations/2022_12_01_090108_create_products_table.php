<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->json('summary');
            $table->json('description')->nullable();
            $table->string('cover')->nullable();
            $table->longText('image');
            $table->string('color')->nullable();
            $table->integer('stock')->default(1);
            $table->enum('condition',[0,1,2])->default(0);
            $table->enum('status',['active','inactive'])->default('active');
            $table->float('price');
            $table->float('discount')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->foreign('cat_id')->references('id')->on('productcategories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
