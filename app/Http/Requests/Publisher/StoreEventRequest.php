<?php

namespace App\Http\Requests\Publisher;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time' => ['required', 'date'],
            'end_time' => ['nullable', 'date', 'after:start_time'],
            'city' => ['required', 'string', 'max:100'],
            'location_details' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
            'image_url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
