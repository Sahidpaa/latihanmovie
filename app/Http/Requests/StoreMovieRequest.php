<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize()
{
    return true;
}

public function rules()
{
    return [
        'id' => 'required|unique:movies,id',
        'judul' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'sinopsis' => 'required',
        'tahun' => 'required|integer',
        'pemain' => 'required',
        'foto_sampul' => 'required|image|max:2048'
    ];
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
}
