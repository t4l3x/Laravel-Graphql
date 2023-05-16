<?php
namespace App\Domains\Authentication\Validators;

use App\Domains\Authentication\Models\User;
use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;



class RegisterValidator extends Validator
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->arg('id'), 'id'),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'in:company,candidate'],
        ];
    }

//    public function validate(array $args): void
//    {
//        $validator = Validator::make($args, $this->rules());
//
//        if ($validator->fails()) {
//            throw new ValidationException($validator);
//        }
//    }
}
