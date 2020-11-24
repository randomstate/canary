<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixFeatureId extends Migration
{
    public function up()
    {
        Schema::table('cage_feature', function(Blueprint $table) {
            $table->string('feature_id')->change();
        });
    }

    public function down()
    {
        Schema::table('cage_feature', function(Blueprint $table) {
            $table->unsignedBigInteger('feature_id')->change();
        });
    }
}
