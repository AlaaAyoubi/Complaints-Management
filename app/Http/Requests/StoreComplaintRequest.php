<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreComplaintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'complaint_type_id' => 'required|exists:complaint_types,id', // يجب أن يكون موجودًا في جدول أنواع الشكاوى
            'details' => [
            'required',
            'string',
            'max:1000',
    // قاعدة regex: يجب أن تحتوي السلسلة على حرف أبجدي واحد على الأقل (عربي أو إنجليزي)
    // وتسمح بالحروف الأبجدية، الأرقام، المسافات، والرموز الشائعة مثل . , ! ? - _ @ # $ % &
            'regex:/^[\p{L}\p{N}\s\.\,\!\?\-\_\@\#\$\%\&]+$/u', // \p{L} للحروف في أي لغة، \p{N} للأرقام
            'regex:/[^\p{N}\s]/u' // يجب أن تحتوي على الأقل على حرف أو رمز ليس رقم أو مسافة
],
        ];
    }

    public function messages(): array
    {
        return [
            'complaint_type_id.required' => 'نوع الشكوى مطلوب.',
            'complaint_type_id.exists' => 'نوع الشكوى المحدد غير صالح.',
            'details.required' => 'تفاصيل الشكوى مطلوبة.',
            'details.string' => 'تفاصيل الشكوى يجب أن تكون نصًا.',
            'details.max' => 'تفاصيل الشكوى لا يمكن أن تتجاوز 1000 حرف.',
            'details.regex' => 'تفاصيل الشكوى يجب أن تحتوي على حروف، ولا يمكن أن تكون أرقامًا فقط أو مسافات.',
        ];
    }
}
