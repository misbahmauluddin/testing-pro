<?php

namespace Botble\RealEstate\Http\Requests;

use Botble\RealEstate\Enums\PropertyStatusEnum;
use Botble\RealEstate\Http\Requests\PropertyRequest as BaseRequest;
use Illuminate\Validation\Rule;

class AccountPropertyRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required',
            'description'     => 'max:350',
            'content'         => 'required',
            'rooms_available'  => 'numeric|min:0|max:10000|nullable',
            'number_capacity' => 'numeric|min:0|max:10000|nullable',
            'number_floor'    => 'numeric|min:0|max:10000|nullable',
            'price'           => 'numeric|min:0|nullable',
            'status'          => Rule::in(PropertyStatusEnum::values()),
        ];
    }
}
