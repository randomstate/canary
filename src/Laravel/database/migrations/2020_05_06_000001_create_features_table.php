<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{

    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->boolean('available')->default(true);
            $table->boolean('enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cages');
    }
}
