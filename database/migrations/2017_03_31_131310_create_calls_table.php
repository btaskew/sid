<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('calls', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('students_id');
          $table->string('title');
          $table->text('body');
          $table->text('response');
          $table->integer('status');
          $table->integer('level');
          $table->integer('staff_id');
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
