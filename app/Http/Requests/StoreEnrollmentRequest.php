<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnrollmentRequest extends FormRequest
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
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('enrollments')->where(fn ($query) => $query->where('course_id', $this->course_id)),
            ],
            'course_id' => [
                'required',
                'exists:courses,id',
            ],
            'enroll_date' => [
                'required',
                'date',
            ],
            'final_fee' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
    
    public function messages(): array
    {
        return [
            'student_id.unique' => 'This student is already enrolled in this course.',
        ];
    }
}
