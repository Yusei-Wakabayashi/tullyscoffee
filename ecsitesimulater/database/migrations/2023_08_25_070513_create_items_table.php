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
            $table->string('pic', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->bigInteger('item_id1');
            $table->bigInteger('item_id2');
            $table->bigInteger('item_id3');
            $table->bigInteger('item_id4');
            $table->bigInteger('item_id5');
            $table->bigInteger('item_id6');
            $table->bigInteger('item_id7');
            $table->bigInteger('item_id8');
            $table->bigInteger('item_id9');
            $table->string('note', 255);
            $table->integer('order')->nullable();
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
