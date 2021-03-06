<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->longText('content')->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('order')->nullable()->default(0);
            $table->string('seo_title', 255)->nullable();
            $table->string('seo_description', 255)->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1)->index();
            $table->tinyInteger('show_index')->nullable()->default(0)->index();
            $table->tinyInteger('show_header')->nullable()->default(0)->index();
            $table->tinyInteger('show_footer')->nullable()->default(0)->index();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
