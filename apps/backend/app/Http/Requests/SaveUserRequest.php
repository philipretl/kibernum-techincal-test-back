<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Venoudev\Results\Exceptions\CheckDataException;

class SaveUserRequest extends FormRequest
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
            'name' => ['required'],
            'avatar' => ['required', 'url']
        ];
    }

    /**
     * @throws CheckDataException
     */
    protected function failedValidation(Validator $validator)
    {
        $exception = new CheckDataException();
        $exception->addFieldErrors($validator->errors());
        throw $exception;
    }
}
