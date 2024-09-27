<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStoreRequest extends FormRequest
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
            'project_id'  => 'required|int|min:0',
            'name'        => 'required|string|max:200',
            'description' => 'sometimes|string|max:500',
            'status'      => ['sometimes', Rule::enum(TaskStatusEnum::class)],
        ];
    }
}
