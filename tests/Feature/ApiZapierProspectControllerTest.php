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
            'name' => 'Dummy Name',
            'email' => 'dummy@email.com',
            'phone' => '+12145418469',
            'location' => 'Dummy Location',
            'date' => '2021-05-23T01:13:32z',
        ];

        $response = $this->post('/api/import-prospect', $data);

        $prospect = Prospect::find((int)$response->getContent());

        $response->assertStatus(200);
        $this->assertSame($prospect->date, '2021-05-23 01:13:32');
    }
}
