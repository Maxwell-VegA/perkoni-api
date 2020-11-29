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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('confirmed');
            $table->string('title');
            $table->integer('base_price');
            $table->string('category');
            $table->text('description');
            $table->jsonb('materials');
            $table->jsonb('sizes');
            $table->jsonb('taggs');
            $table->timestamps();
            // perhaps category should be pulled in from another table?

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
