<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    if ($this->routeIs('user.login')) {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:8',
        ];
    } elseif ($this->routeIs('user.store')) {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'nullable|string',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|min:8|confirmed',
        ];
    } elseif ($this->routeIs('user.update')) {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'nullable|string',
            'email' => 'required|string|email|unique:users,email,' . $this->user->id . '|max:255',
            'password' => 'nullable|min:8|confirmed',
        ];
    } elseif ($this->routeIs('user.email')) {
        return [
            'email' => 'required|string|email|max:255',
        ];
    } elseif ($this->routeIs('user.password')) {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    } elseif ($this->routeIs('user.image') || $this->routeIs('profile.image') || $this->routeIs('ocr.image')) {
        return [
            'image' => 'required|image|mimes:jpg,bmp,png|max:5000',
        ];
    }

    return [];
}

}
