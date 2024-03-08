<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female,Others',
            'civil_status' => 'required|in:Married,Single,Divorced,Widowed',
            'occupation' => 'required|string|max:50',
            'contact_number' => 'required|string|max:20',
            'email_address' => 'nullable|email|max:50',
            'national_id_number' => 'nullable|string|max:20',
            'passport_number' => 'nullable|string|max:20',
        ];
    }
}
