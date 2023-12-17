<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'taskname' => 'required|max:255',
            'assigned_to' => [
                'required',
                function($attributes, $value, $fail) {
                    if(Task::find(explode('/', request()->requestUri)[2])->assigned_to !== $value) {
                        $fail("You don't have a permission");
                    }
                }
            ],
        ];
    }
}
