<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SelectAllPetsSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $storeProcedure = "DROP PROCEDURE IF EXISTS `select_all_pets`;
                            CREATE PROCEDURE `select_all_pets` ()
                            BEGIN

                            SELECT * FROM pets;
                            END;";

        \DB::unprepared($storeProcedure);
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
