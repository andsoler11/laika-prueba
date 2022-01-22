<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePetSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $storeProcedure = "
                            DROP PROCEDURE IF EXISTS `update_pet`;

                            CREATE PROCEDURE `update_pet`( 
                                IN idx int,
                                IN vet bigint(20), 
                                IN pet_name varchar(255),
                                IN owner_name varchar(255),
                                IN animal varchar(255),
                                IN updated timestamp
                            ) 
                            BEGIN 

                            UPDATE pets 
                            SET vet_id = vet, 
                                pet_name = pet_name,
                                owner_name = owner_name,
                                animal = animal,
                                updated_at = updated
                            WHERE id = idx;

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
