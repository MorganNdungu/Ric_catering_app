<?php

namespace App\Http\Requests;

use App\Http\Requests\UpdateItemRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
    public function rules()
{
    if (auth()->user()->hasRole('admin')) {
        
       
    return [
        'title' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ];
}else{
    return abort(403);
}
}

}
