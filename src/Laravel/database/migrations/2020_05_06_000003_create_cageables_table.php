<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCageablesTable extends Migration
{
    public function up()
    {
        Schema::create('cageables', function (Blueprint $table) {
            $table->unsignedBigInteger('cage_id');
            $table->unsignedBigInteger('item_id');
            $table->string('item_type');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cageables');
    }
}
