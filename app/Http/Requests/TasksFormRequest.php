<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksFormRequest extends FormRequest
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
            'dateOfMeasurement' => 'nullable|date',
            'mk' => 'nullable ',
            'mkcold' => 'nullable ',
            'osv' => 'nullable ',
            'osvEvak' => 'nullable ',
            'sh' => 'nullable ',
            'shobSgr' => 'nullable ',
            'shokolSr' => 'nullable ',
            'vent' => 'nullable ',
            'klim' => 'nullable ',
            'f0' => 'nullable ',
            'z' => 'nullable ',
            'm' => 'nullable ',
            'izol' => 'nullable ',
            'dtz' => 'nullable ',
            'wayOfShowingDocumentation'=> 'nullable|string',
            'certificateNumber'=> 'nullable|string',
            'certificateDate'=> 'nullable|string',
            'nextMeasurement'=> 'nullable|date',
            'mkNext' => 'nullable ',
            'mkcoldNext' => 'nullable ',
            'osvNext' => 'nullable ',
            'osvEvakNext' => 'nullable ',
            'shNext' => 'nullable ',
            'shobSgrNext' => 'nullable ',
            'shokolSrNext' => 'nullable ',
            'ventNext' => 'nullable ',
            'klimNext' => 'nullable ',
            'f0Next' => 'nullable ',
            'zNext' => 'nullable ',
            'mNext' => 'nullable ',
            'izolNext' => 'nullable ',
            'dtzNext' => 'nullable ',
            "invoice" => 'nullable | string',
            "invoice_date" => 'nullable | date',
            "payment_method" => 'nullable | string',
            "paid" => 'nullable',
            "contragent_sum" => 'nullable | numeric',
            "total_sum" => 'nullable | numeric',
            'client_id' => 'required|integer',
            'contragent' => 'nullable|string',
            "price_without_vat" => 'nullable | numeric',
            "courrierDetails" => 'nullable',
        ];

    }
}
