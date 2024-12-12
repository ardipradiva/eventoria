<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_name' => 'required|string',
            'event_description' => 'required|string',
            'event_location' => 'required|string',
            'event_date' => 'required|string',
            'event_image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
            'event_price' => 'required|integer',
            'event_provider' => 'required|string',
            //
        ];
    }
}
