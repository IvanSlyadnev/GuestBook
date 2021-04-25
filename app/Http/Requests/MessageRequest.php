<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'name' => 'required|max:1000',
            'image' => 'dimensions:min_width=100,min_height=100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Обязательноо введите текст сообщения',
            'name.max' => 'Объем сообщения должен быть не более 1000 символов',
            'image.dimensions' => 'Картинка должен быть больше чем 100 на 100'
        ];
    }

}
