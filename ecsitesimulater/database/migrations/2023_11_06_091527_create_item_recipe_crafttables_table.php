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
        Schema::create('item_recipe_crafttables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('item_id1')->nullable();
            $table->bigInteger('item_id2')->nullable();
            $table->bigInteger('item_id3')->nullable();
            $table->bigInteger('item_id4')->nullable();
            $table->bigInteger('item_id5')->nullable();
            $table->bigInteger('item_id6')->nullable();
            $table->bigInteger('item_id7')->nullable();
            $table->bigInteger('item_id8')->nullable();
            $table->bigInteger('item_id9')->nullable();
            $table->bigInteger('crafttable_id');
            $table->integer('item_num')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_recipe_crafttables');
    }
};
