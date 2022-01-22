<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SelectPetByIdSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $storeProcedure = "DROP PROCEDURE IF EXISTS `select_pet_by_id`;
                        CREATE PROCEDURE `select_pet_by_id` (IN idx int)
                        BEGIN

                        SELECT * FROM pets WHERE id = idx;
                        END;";

                        DB::unprepared($storeProcedure);
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
