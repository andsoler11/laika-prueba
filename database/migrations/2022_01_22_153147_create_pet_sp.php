<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $storeProcedure = "
                            DROP PROCEDURE IF EXISTS `create_pet`;

                            CREATE PROCEDURE `create_pet`( 
                                IN vet bigint(20), 
                                IN pet_name varchar(255),
                                IN owner_name varchar(255),
                                IN animal varchar(255),
                                IN created timestamp,
                                IN updated timestamp
                            ) 
                            BEGIN 

                            INSERT INTO pets (vet_id, pet_name, owner_name, animal, created_at, updated_at) 
                            VALUES (vet, pet_name, owner_name, animal, created, updated);

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
        Schema::dropIfExists('pet_sp');
    }
}
