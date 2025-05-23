<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('sell');
            $table->foreignId('productcondition_id')->constrained()->cascadeOnDelete();

             $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
             
            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_image');
            $table->string('product_price');

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
        Schema::dropIfExists('exhibitions');
    }
}
