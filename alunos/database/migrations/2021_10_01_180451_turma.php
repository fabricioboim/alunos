<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Turma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
        });
        DB::table('turmas')->insert(array(
            ['nome' =>'Turma 1'],
            ['nome' =>'Turma 2'],
            ['nome' =>'Turma 3'],
            ['nome' =>'Turma 4'],
            ['nome' =>'Turma 5'],
            ['nome' =>'Turma 6']
            
        ));
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
