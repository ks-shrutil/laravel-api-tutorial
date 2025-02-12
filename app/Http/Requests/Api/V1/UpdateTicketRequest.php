<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
