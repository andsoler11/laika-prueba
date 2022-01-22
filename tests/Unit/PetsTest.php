<?php

namespace Tests\Unit;

use Tests\TestCase;

class PetsTest extends TestCase
{
    public function test_get_all_pets_not_key()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('api/pets');
        $response->assertStatus(403);
    }

    public function test_get_all_pets()
    {
        $response = $this->withHeaders([
            'token' => 'api-key-laika',
            'Accept' => 'application/json'
        ])->get('api/pets');
        $response->assertStatus(200);
    }

    public function test_get_one_pet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->get('api/pets/1');
        $response->assertStatus(200);
    }

    public function test_save_pet_empty_input()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->post('api/pets', [
            "vet_id" => "1",
            "pet_name" => "test",
            "owner_name" => "test",
            "animal" => ""
        ]);
        $response->assertStatus(422);
    }

    public function test_save_pet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->post('api/pets', [
            "vet_id" => "1",
            "pet_name" => "test",
            "owner_name" => "test",
            "animal" => "test"
        ]);
        $response->assertStatus(200);
    }

    public function test_update_pet_not_existing()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/pets/123345', [
            "vet_id" => "1",
            "pet_name" => "test",
            "owner_name" => "test",
            "animal" => "test"
        ]);
        $response->assertStatus(404);
    }


    public function test_update_pet_not_existing_vet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/pets/1', [
            "vet_id" => "1234",
            "pet_name" => "test",
            "owner_name" => "test",
            "animal" => "test"
        ]);
        $response->assertStatus(404);
    }



    public function test_update_pet_empty_input()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/pets/1', [
            "vet_id" => "1234",
            "pet_name" => "test",
            "owner_name" => "test",
            "animal" => ""
        ]);
        $response->assertStatus(422);
    }


    public function test_update_pet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/pets/1', [
            "vet_id" => "1",
            "pet_name" => "test",
            "owner_name" => "test",
            "animal" => "test"
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_pet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->delete('api/pets/123456');
        $response->assertStatus(200);
    }
}
