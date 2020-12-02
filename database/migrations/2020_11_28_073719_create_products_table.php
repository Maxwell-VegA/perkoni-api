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
            $table->string('title');
            // $table->boolean('confirmed');
            $table->string('mainCategory');
            $table->string('subcategory');
            $table->text('description');
            $table->boolean('is_new');
            // research money keeping in sql
            $table->integer('base_price');
            $table->integer('sale_price');
            $table->boolean('on_sale');
            $table->jsonb('types');
            $table->string('operator');
            $table->jsonb('sizes');
            $table->jsonb('taggs');
            // $table->jsonb('');
            $table->string('gender');
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
