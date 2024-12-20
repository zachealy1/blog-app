<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * These rules validate the user's input for updating their profile, ensuring the data
     * is properly formatted and unique where necessary.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     * An array of validation rules for the `name` and `email` fields.
     */
    public function rules(): array
    {
        return [
            // Ensure the name is required, a string, and has a maximum length of 255 characters.
            'name' => ['required', 'string', 'max:255'],

            // Ensure the email is required, lowercase, a valid email format, and unique among users,
            // excluding the currently authenticated user's email.
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id), // Ignore the current user's email when checking uniqueness.
            ],
        ];
    }
}
