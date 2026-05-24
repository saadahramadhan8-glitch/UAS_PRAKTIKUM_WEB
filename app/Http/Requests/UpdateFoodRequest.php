<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
{
    /**
     * Authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [

            'title' => 'required|max:255',

            'description' => 'required',

            'quantity' => 'required|integer|min:1',

            'expired_at' => 'required|date',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'address' => 'required',

            'latitude' => 'nullable|numeric',

            'longitude' => 'nullable|numeric',

        ];
    }
}