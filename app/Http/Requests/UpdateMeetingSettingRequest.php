<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetingSettingRequest extends FormRequest
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
        return [
            'MODERATOR_RIGHTS' => 'required|string|in:enabled,disabled',
            'DEFAULT_USERNAME' => 'required|string|max:15',
        ];
    }

    public function attributes()
    {
        return [
            'MODERATOR_RIGHTS' => __('Moderator Rights'),
            'DEFAULT_USERNAME' => __('Default Username'),
        ];
    }
}
