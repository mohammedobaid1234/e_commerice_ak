<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('vendor_type')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('image')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('categories');
            $table->foreign('vendor_type')->references('id')->on('type_of_vendors');
            $table->softDeletes();
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
        Schema::dropIfExists('categories');
    }
}
