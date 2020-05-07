<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCageFeatureTable extends Migration
{
    public function up()
    {
        Schema::create('cage_feature', function (Blueprint $table) {
            $table->unsignedBigInteger('cage_id');
            $table->unsignedBigInteger('feature_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cage_feature');
    }
}
