<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;
use Ongoingcloud\Laravelcrud\General\HandlePermission;

class ListTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {        
        return HandlePermission::authorize('list_todo');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
       
            ];
    }
}
