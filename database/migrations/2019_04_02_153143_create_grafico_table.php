<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraficoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grafico', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key_data',255);
            $table->string('operation',50);
            $table->string('dimension',255);
            $table->string('medida',255);
            $table->string('title_graphic',150);
            $table->string('title_dataset',150);
            $table->string('type',15);
            $table->bigInteger('dashboard_id');
            $table->timestamps();
            //foreign_key
            $table->foreign('dashboard_id')->references('id')->on('dashboard')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grafico');
    }
}
