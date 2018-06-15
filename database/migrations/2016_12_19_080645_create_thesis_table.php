<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('t_title');
            $table->string('t_studname');
            $table->string('t_sv');
            $table->string('t_type');
            $table->string('t_thesis');
            $table->string('stud_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis');
    }
}
