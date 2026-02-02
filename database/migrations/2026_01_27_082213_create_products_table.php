<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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

        $table->string('name');
        $table->string('category')->nullable();
        $table->string('brand')->nullable();
        $table->string('image')->nullable();

        $table->decimal('price', 10, 2);
        $table->decimal('discount', 10, 2)->default(0);
        $table->boolean('isNew')->default(false);
        $table->enum('availability', ['in stock', 'out of stock'])->default('in stock');


        $table->text('description')->nullable();
        $table->decimal('rating', 3, 2)->default(0); // ex: 4.50
        $table->integer('reviews')->default(0);

        $table->json('reviewsList')->nullable();
        $table->boolean('isFavorite')->default(false);

        $table->json('ingredients')->nullable();
        $table->text('usage')->nullable();
        $table->string('dosageForm')->nullable();
        $table->date('expiryDate')->nullable();

        $table->boolean('requiresPrescription')->default(false);
     

        $table->text('sideEffects')->nullable();
        $table->text('warning')->nullable();
        $table->text('storage')->nullable();

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
};
