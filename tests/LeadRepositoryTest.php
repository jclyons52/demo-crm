<?php

use App\Models\Lead;
use App\Repositories\LeadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LeadRepositoryTest extends TestCase
{
    use MakeLeadTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LeadRepository
     */
    protected $leadRepo;

    public function setUp()
    {
        parent::setUp();
        $this->leadRepo = App::make(LeadRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLead()
    {
        $lead = $this->fakeLeadData();
        $createdLead = $this->leadRepo->create($lead);
        $createdLead = $createdLead->toArray();
        $this->assertArrayHasKey('id', $createdLead);
        $this->assertNotNull($createdLead['id'], 'Created Lead must have id specified');
        $this->assertNotNull(Lead::find($createdLead['id']), 'Lead with given id must be in DB');
        $this->assertModelData($lead, $createdLead);
    }

    /**
     * @test read
     */
    public function testReadLead()
    {
        $lead = $this->makeLead();
        $dbLead = $this->leadRepo->find($lead->id);
        $dbLead = $dbLead->toArray();
        $this->assertModelData($lead->toArray(), $dbLead);
    }

    /**
     * @test update
     */
    public function testUpdateLead()
    {
        $lead = $this->makeLead();
        $fakeLead = $this->fakeLeadData();
        $updatedLead = $this->leadRepo->update($fakeLead, $lead->id);
        $this->assertModelData($fakeLead, $updatedLead->toArray());
        $dbLead = $this->leadRepo->find($lead->id);
        $this->assertModelData($fakeLead, $dbLead->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLead()
    {
        $lead = $this->makeLead();
        $resp = $this->leadRepo->delete($lead->id);
        $this->assertTrue($resp);
        $this->assertNull(Lead::find($lead->id), 'Lead should not exist in DB');
    }
}
