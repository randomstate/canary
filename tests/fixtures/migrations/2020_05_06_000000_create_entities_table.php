<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{

    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
    }
}
