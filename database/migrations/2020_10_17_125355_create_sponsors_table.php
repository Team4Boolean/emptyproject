<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    
    public function up()
    {
      Schema::create('sponsors', function (Blueprint $table) {

        $table -> engine = 'InnoDB';

        $table -> id();

        $table -> bigInteger('flat_id') -> unsigned(); // chiave esterna 1
        $table -> bigInteger('advertising_id') -> unsigned(); // chiave esterna 2

        $table -> dateTime('expire');

        $table -> timestamps();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
