<?php

namespace Tests\Unit;

use Tests\TestCase;

class VetsTest extends TestCase
{
    public function test_get_all_vets_not_key()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('api/vets');
        $response->assertStatus(403);
    }

    public function test_get_all_vets()
    {
        $response = $this->withHeaders([
            'token' => 'api-key-laika',
            'Accept' => 'application/json'
        ])->get('api/vets');
        $response->assertStatus(200);
    }

    public function test_get_one_vet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->get('api/vets/1');
        $response->assertStatus(200);
    }


    public function test_save_vet_invalid_phone()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->post('api/vets', [
            "name" => "test",
            "city" => "test",
            "phone" => "123456789011"
        ]);
        $response->assertStatus(422);
    }

    public function test_save_vet_empty_input()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->post('api/vets', [
            "name" => "test",
            "city" => "",
            "phone" => "1234567890"
        ]);
        $response->assertStatus(422);
    }

    public function test_save_vet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->post('api/vets', [
            "name" => "test",
            "city" => "test",
            "phone" => "1234567890"
        ]);
        $response->assertStatus(200);
    }


    public function test_update_vet_not_existing()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/vets/123', [
            "name" => "test",
            "city" => "test",
            "phone" => "1234567890"
        ]);
        $response->assertStatus(404);
    }

    public function test_update_vet_invalid_phone()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/vets/1', [
            "name" => "test",
            "city" => "test",
            "phone" => "12345678901"
        ]);
        $response->assertStatus(422);
    }

    public function test_update_vet_empty_input()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/vets/1', [
            "name" => "test",
            "city" => "",
            "phone" => "1234567890"
        ]);
        $response->assertStatus(422);
    }

    public function test_update_vet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->put('api/vets/1', [
            "name" => "test",
            "city" => "test",
            "phone" => "1234567890"
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_vet()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'token' => 'api-key-laika'
        ])->delete('api/vets/123456');
        $response->assertStatus(200);
    }
}
