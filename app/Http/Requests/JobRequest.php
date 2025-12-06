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
            'title' => ['required', 'string', 'min:6', 'max:25'],
            'salary' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'min:3', 'regex:/^[A-Za-z\s]+$/'],
            'description' => ['required', 'string', 'min:6'],
            'schedule' => ['required', 'string', 'min:6'],
            'avatar' => $this->isMethod('post')
                ? 'required|image|mimes:jpg,jpeg,png|max:2048'
                : 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Job title is required.',
            'title.min' => 'Job title must be at least 6 characters.',
            'title.max' => 'Job title cannot exceed 25 characters.',
            'salary.required' => 'Salary is required.',
            'location.required' => 'Location is required.',
            'location.min' => 'Location must be at least 3 characters.',
            'description.required' => 'Job description is required.',
            'description.min' => 'Description must be at least 6 characters.',
            'schedule.required' => 'Schedule is required.',
            'schedule.min' => 'Schedule must be at least 6 characters.',
            'avatar.required' => 'Please upload a job avatar.',
            'avatar.image' => 'The uploaded file must be an image.',
            'avatar.mimes' => 'Avatar must be a JPG, JPEG, or PNG image.',
            'avatar.max' => 'Avatar size cannot exceed 2MB.',
        ];
    }
}
