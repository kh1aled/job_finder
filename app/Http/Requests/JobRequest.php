<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => ["required", "string", "min:6", "max:25"],
            'salary' => ["required", "string"],
            'location' => ["required", "string", "min:3"],
            'url' => ["required", "string", "min:6"],
            'schedule' => ["required", "string", "min:6"],
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
