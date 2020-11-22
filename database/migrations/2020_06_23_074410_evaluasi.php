<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evaluasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('Klas1');
            $table->integer('Klas2');
            $table->integer('Klas3');
            $table->float('SSW1');
            $table->float('SSW2');
            $table->float('SSW3');
            $table->float('SSB');
            $table->float('DBI');
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
        Schema::dropIfExists('evaluasis');
    }
}
