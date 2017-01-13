<?php

use Faker\Factory as Faker;
use App\leads\Models\Lead;
use App\leads\Repositories\LeadRepository;

trait MakeLeadTrait
{
    /**
     * Create fake instance of Lead and save it in database
     *
     * @param array $leadFields
     * @return Lead
     */
    public function makeLead($leadFields = [])
    {
        /** @var LeadRepository $leadRepo */
        $leadRepo = App::make(LeadRepository::class);
        $theme = $this->fakeLeadData($leadFields);
        return $leadRepo->create($theme);
    }

    /**
     * Get fake instance of Lead
     *
     * @param array $leadFields
     * @return Lead
     */
    public function fakeLead($leadFields = [])
    {
        return new Lead($this->fakeLeadData($leadFields));
    }

    /**
     * Get fake data of Lead
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLeadData($leadFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'email' => $fake->word,
            'expression_of_interest' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $leadFields);
    }
}
