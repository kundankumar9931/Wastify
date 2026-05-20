<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'registration_number' => ['nullable', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNo' => ['required', 'string', 'max:20'],
            'street_name' => ['required', 'string', 'max:100'],
            'building_type' => ['required', 'string', 'max:50'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'registration_number' => $input['registration_number'],
            'email' => $input['email'],
            'phoneNo' => $input['phoneNo'],
            'street_name' => $input['street_name'],
            'building_type' => $input['building_type'],
            'role' => 'user',
            'password' => Hash::make($input['password']),
        ]);

        return $user;
    }
}