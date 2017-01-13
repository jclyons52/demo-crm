<?php

namespace App\leads\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\leads\Models\Lead;

class CreateLeadRequest extends FormRequest
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
