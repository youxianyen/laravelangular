<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('table1', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('article')->nullable();
            $table->string('username', 12)->unique();
        });

        Schema::rename('table1', 'table_1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('table');
    }
}
