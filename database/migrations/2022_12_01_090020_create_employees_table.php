<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->string('job_title')->nullable();
            $table->string('image')->nullable();
            $table->longtext('youtube_url')->nullable();
            $table->longtext('fb_url')->nullable();
            $table->string('linked_url')->nullable();;
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('behance_url')->nullable();
            $table->string('whatsapp_url')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
