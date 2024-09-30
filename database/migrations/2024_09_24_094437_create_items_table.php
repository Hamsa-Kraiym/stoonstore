<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->comment('The item name');
            $table->integer('category', false, true)->nullable(false)->comment('The item category ID');
            $table->addColumn('mediumblob', 'picture')->nullable(true)->comment('The item image file');
            $table->string('picType', 50)->nullable(true)->comment('The image type (png, jpeg, pmp, etc)');
            $table->timestamps();
            $table->unique(['name', 'category']);
            if (Schema::hasTable('categories')) $table->foreign('category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
