<?php

namespace App\Http\Requests\Hotel\HotelRules;

use App\Enums\HotelRule\HotelRuleChildPolicy;
use App\Enums\HotelRule\HotelRulePetPolicy;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class HotelRulesRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Hotel,id'],
            'check_in_time' => ['required'],
            'check_out_time' => ['required'],
            'pet_policy' => ['nullable', new Enum(HotelRulePetPolicy::class)],
            'child_policy' => ['nullable', new Enum(HotelRuleChildPolicy::class)],
            'extra_bed_fee_check' =>['nullable'],
            'extra_bed_fee' =>['nullable','numeric','min:0'],
        ];
    }

}
