<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            "id_number" => ["required", "string"],
            "first_name" => ["required", "string"],
            "last_name" => ["required", "string"],
            "phone_number" => ["nullable", "string"],
            "position" => ["nullable", "string"],
            "birth_date" => ["nullable", "string"],
            "email" => ["nullable", "email"],
            "province" => ["nullable", "string"],
            "city" => ["nullable", "string"],
            "street" => ["nullable", "string"],
            "zip_code" => ["nullable", "string"],
            "id_scan" => ["nullable", "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
        ];
    }
}
