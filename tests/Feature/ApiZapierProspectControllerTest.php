<?php

namespace Tests\Feature;

use App\Models\Prospect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiZapierProspectControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_date_insert_correctly_from_zapier()
    {
        $this->withoutExceptionHandling();

        $data = [
            "owner" => "4893827000000316001",
            "prospect_id" => "4893827000000598001",
            "modified_by" => "4893827000000316001",
            "prospect_phone" => "+12812043170",
            "prospect_email" => "atilano_c3@hotmail.com",
            "prospect_mobile" => "",
            "prospect_gym" => "Victory Park",
            "prospect_city" => "",
            "prospect_state" => "",
            "created_by_name" => "Richard",
            "modified_by_name" => "Richard",
            "prospect_first_name" => "Atilano",
            "prospect_last_name" => "Martinez",
            "prospect_source" => "Facebook",
        ];

        $response = $this->post('/api/import-prospect', $data);

        $prospect = Prospect::find((int)$response->getContent());

        $response->assertStatus(200);
        $this->assertSame($prospect->prospect_source, "Facebook");
    }
}
