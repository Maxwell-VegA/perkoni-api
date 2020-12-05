<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    
    public function up()
    // $defaultImgArr = json_encode([{fileName: 'photo_1607001055.jpg'}]);
    // $defaultImgArr = [];
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('title', 255);
            $table->boolean('isPublic');
            $table->boolean('isConfirmed')->nullable();
            $table->boolean('toBeDeleted')->default(false);
            // $table->softDeletes('deleted_at', 0);
            $table->string('mainCategory', 50);
            $table->string('subcategory', 50);
            $table->text('description');
            $table->boolean('is_new');
            // research money keeping in sql
            $table->float('base_price', 8, 2);
            $table->float('sale_price', 8, 2);
            $table->boolean('on_sale');
            // $table->boolean('operatorIsMultiply');
            $table->boolean('operatorIsMultiply');
            $table->jsonb('types');
            $table->jsonb('sizes');
            $table->jsonb('taggs');
            // ->default(new Expression('(JSON_ARRAY())'))
            // Tecincally though these aren't json objects. They are arrays of objects (maybe not even json objects).
            $table->string('gender', 255)->default('genderless');
            $table->jsonb('images')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}