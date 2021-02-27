<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Post extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required'
        ];
    }


    /**
     * It Changes names from JSON data only when
     * you see a wrong request message.
     * The 'new' names is only seen on the
     * messages() function of this class.
     * The 'new' names has been created for show
     * a column record to Client friendly than the database.
     * 
     * @return array
     */
    public function attributes(){
        return [
            'title' => 'título',
            'body' => 'cuerpo'
        ];
    }


    public function messages(){
        return [
            'title.required' => 'El :attribute del post es obligatorio',
            'title.max' => 'El :attribute del post es demasiado largo. Debe tener menos que 255 caracteres',
            'body.required' => 'El :attribute del post es obligatorio',
        ];
    }
}
