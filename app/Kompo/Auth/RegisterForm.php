<?php

namespace App\Kompo\Auth;

use App\Models\User;
use Kompo\Form;
use Laravel\Fortify\Rules\Password;
use Illuminate\Auth\Events\Registered;

class RegisterForm extends Form
{
    public $model = User::class;

    public $containerClass = 'container min-h-screen flex flex-col sm:justify-center items-center';
    public $class = 'sm:mx-auto sm:w-full sm:max-w-md';

    public function completed()
    {
        event(new Registered($this->model));

        auth()->guard()->login($this->model);
    }

    public function response()
    {
        return redirect()->route('dashboard');
    }

	public function komponents()
	{
		return [
			_Input('Name')
                ->name('name'),
            _Input('Email')
                ->name('email'),
			_Password('Password')
                ->name('password'),
			_Password('Confirm Password')
                ->name('password_confirmation', false),
            _Checkbox('I agree to the terms of service and privacy policy')
                ->name('terms', false),
			_FlexEnd(
                _SubmitButton('Register')
            )
		];
	}

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => static::passwordRules(),
            'terms' => ['required', 'accepted'],
        ];
    }

    public static function passwordRules() //Extracted into it's own method to reuse in ResetPasswordForm
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
}
