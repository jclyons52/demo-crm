<?php

namespace App\leads\Repositories;

use App\leads\Models\Lead;
use InfyOm\Generator\Common\BaseRepository;

class LeadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'expression_of_interest'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Lead::class;
    }
}
