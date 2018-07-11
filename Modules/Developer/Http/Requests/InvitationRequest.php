<?php

namespace Modules\Developer\Http\Requests;

use App\Entities\Invitation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;


class InvitationRequest extends FormRequest
{
    public function __construct(ValidationFactory $validationFactory)
    {
        $validationFactory->extend(
            'valid_invitation',
            function ($attribute, $value, $parameters) {
                return Invitation::isValidNewInvitation($value);
            },
            'Can not send invitation to this email.'
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|max:191|valid_invitation|unique:users,email',
            'user' => 'required|max:100',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }
}
