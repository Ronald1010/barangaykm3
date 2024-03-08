<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Assuming authorization logic is implemented elsewhere
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'age' => 'required|integer',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'gender' => 'required|string',
            'purpose' => 'required|string',
            'certificate_type' => 'required|string',
            'request_date' => 'required|date',
            'issued_date' => 'nullable|date',
            'status' => 'required|string',
        ];
    }
}
