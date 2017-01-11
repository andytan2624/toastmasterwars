<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMeetingFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'club_id' => 'required|exists:clubs',
            'chairman' => 'required|exists:users',
            'serjeant_at_arms' => 'required|exists:users',
            'secretary' => 'required|exists:users',
        ];
    }
}
