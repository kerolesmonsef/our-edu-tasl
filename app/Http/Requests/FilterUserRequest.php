<?php /** @noinspection PhpLanguageLevelInspection */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', 'in:authorized,decline,refunded'],
            'currency' => "nullable",

            'from_amount' => ['nullable', "numeric", "after_or_equal:from_amount"],
            "to_amount" => ['required_with:from_amount', "numeric"],

            'from_date' => ['nullable', "date", "after_or_equal:to_date"],
            "to_date" => ['required_with:from_date', 'date'],


        ];
    }
}
