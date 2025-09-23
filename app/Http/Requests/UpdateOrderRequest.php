<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
        'user_id' => 'sometimes|exists:users,id',  // only if you want to change the user
        'status' => 'sometimes|string',            // optional, e.g., pending, completed
        'total' => 'sometimes|numeric',           // optional, new total amount
    ];
}

}
