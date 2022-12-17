<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->string('slug')->unique();
            $table->json('short_des')->nullable();
            $table->json('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('servicecategory_id');
            $table->foreign('servicecategory_id')->references('id')->on('servicecategories')->onDelete('CASCADE');
            $table->enum('is_featured',['featured','Not'])->default('Not');
            $table->enum('status',['active','inactive'])->default('active');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
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
        Schema::dropIfExists('services');
    }
}
