<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LeadApiTest extends TestCase
{
    use MakeLeadTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLead()
    {
        $lead = $this->fakeLeadData();
        $this->json('POST', '/api/v1/leads', $lead);

        $this->assertApiResponse($lead);
    }

    /**
     * @test
     */
    public function testReadLead()
    {
        $lead = $this->makeLead();
        $this->json('GET', '/api/v1/leads/'.$lead->id);

        $this->assertApiResponse($lead->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLead()
    {
        $lead = $this->makeLead();
        $editedLead = $this->fakeLeadData();

        $this->json('PUT', '/api/v1/leads/'.$lead->id, $editedLead);

        $this->assertApiResponse($editedLead);
    }

    /**
     * @test
     */
    public function testDeleteLead()
    {
        $lead = $this->makeLead();
        $this->json('DELETE', '/api/v1/leads/'.$lead->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/leads/'.$lead->id);

        $this->assertResponseStatus(404);
    }
}
