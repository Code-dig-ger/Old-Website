<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('platform' , ['codeforces' , 'codechef' , 'uva' , 'spoj']);
            $table->integer('topic_id')->unsigned();
            $table->integer('generaltopic_id')->unsigned();
            $table->string('code')->unique();
            $table->integer('dif');
            $table->text('desc')->nullable();
            $table->text('link');
            $table->enum('status' , ['pending' , 'accepted']);
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
        Schema::dropIfExists('problems');
    }
}
