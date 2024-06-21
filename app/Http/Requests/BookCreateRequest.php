<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
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
               'title' => 'required|max:100',
               'author' => 'required|max:50',
               'description' => 'required',
               'price' => 'required|numeric|min:0',
               'coverpage' => 'required|image|mimes:jpeg,png,jpg,gif',
               'pdf' => 'required|mimes:pdf,doc,docx'
        ];
    }
}
