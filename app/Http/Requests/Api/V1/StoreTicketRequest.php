<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class StoreTicketRequest extends BaseTicketRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function rules()
    {
        //
    }



}
