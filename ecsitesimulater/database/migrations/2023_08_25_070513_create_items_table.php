<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('pic', 255);
            $table->string('name', 255);
            $table->bigInteger('item_id1')->nullable();
            $table->bigInteger('item_id2')->nullable();
            $table->bigInteger('item_id3')->nullable();
            $table->bigInteger('item_id4')->nullable();
            $table->bigInteger('item_id5')->nullable();
            $table->bigInteger('item_id6')->nullable();
            $table->bigInteger('item_id7')->nullable();
            $table->bigInteger('item_id8')->nullable();
            $table->bigInteger('item_id9')->nullable();
            $table->string('note', 255)->nullable();
            $table->integer('order');
            $table->bigInteger('crafttable_id')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
