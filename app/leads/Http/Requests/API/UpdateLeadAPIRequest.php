<?php

namespace App\leads\Http\Requests\API;

use App\leads\Models\Lead;
use InfyOm\Generator\Request\APIRequest;

class UpdateLeadAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Lead::$rules;
    }
}
