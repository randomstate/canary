<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('cage_feature', function(Blueprint $table) {
            $table->foreign('cage_id')->references('id')->on('cages');
            $table->foreign('feature_id')->references('id')->on('features');
        });

        Schema::table('cageables', function (Blueprint $table) {
            $table->foreign('cage_id')->references('id')->on('cages');
        });
    }

    public function down()
    {
        Schema::table('cage_feature', function(Blueprint $table) {
            $table->dropForeign('cage_feature_cage_id_foreign');
            $table->dropForeign('cage_feature_feature_id_foreign');
        });

        Schema::table('cageables', function(Blueprint $table) {
            $table->dropForeign('cageables_feature_id_foreign');
        });
    }
}
