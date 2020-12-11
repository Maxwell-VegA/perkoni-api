<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('title', 255);
            $table->boolean('isPublic');
            $table->boolean('isConfirmed')->nullable();
            $table->boolean('toBeDeleted')->nullable()->default(false);
            // $table->softDeletes('deleted_at', 0);
            $table->string('mainCategory', 50);
            $table->string('subcategory', 50);
            $table->string('description', 255);
            $table->text('longDescription')->nullable()->default(null);
            $table->boolean('is_new');
            // research money keeping in sql
            $table->float('base_price', 8, 2);
            $table->float('sale_price', 8, 2)->nullable();
            $table->boolean('on_sale');
            $table->boolean('operatorIsMultiply');
            $table->jsonb('types')->nullable();
            $table->jsonb('sizes')->nullable();
            $table->jsonb('taggs')->nullable();
            // ->default(new Expression('(JSON_ARRAY())'))
            // Tecincally though these aren't json objects. They are arrays of objects (maybe not even json objects).
            $table->string('gender', 255)->default('genderless');
            $table->jsonb('images')->nullable();
            $table->jsonb('related')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}