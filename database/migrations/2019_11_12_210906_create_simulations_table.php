<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('simulations', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id',false)->nullable();
            $table->string('simulation_name');
            $table->string('simulation_location');


            $table->string('creatorname');
            $table->string('numberofweeks');
            $table->string('numberofsims');
            
            $table->text('populationType');
            $table->text('resources');
            $table->text('states');
            $table->text('transitionProbability');
            $table->string('datasheetURI')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
