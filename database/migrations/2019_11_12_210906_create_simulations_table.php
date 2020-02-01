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
            $table->unsignedInteger('project_id',false)->nullable();
            $table->string('name')->nullable();
            $table->string('numberofweeks')->nullable();
            $table->string('numberofsims')->nullable();
            $table->string('location')->nullable();
            $table->text('resources')->nullable();
            $table->text('subresources')->nullable();
            $table->text('states')->nullable();
            $table->text('table')->nullable();
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
