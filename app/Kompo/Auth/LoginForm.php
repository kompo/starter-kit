<?php

namespace App\Kompo\Auth;

use Kompo\Form;

class LoginForm extends Form
{
    public $submitTo = 'login';
    public $redirectTo = 'dashboard';

    public $containerClass = 'container min-h-screen flex flex-col sm:justify-center items-center';
    public $class = 'sm:mx-auto sm:w-full sm:max-w-md';

	public function render()
	{
		return [
            session('status') ? //See ResetPasswordForm: to confirm the password has been reset...
                _Html(session('status'))->class('mb-4 p-4 font-medium text-sm bg-green-100 text-green-600') :
                null,

			_Input('Email')->name('email'),
			_Password('Password')->name('password'),
            _Checkbox('Remember me')->name('remember'),
			_FlexEnd(
                _Link('Forgot your password?')
                    ->href('password.request')
                    ->class('text-gray-600 text-sm'),
                _SubmitButton('Login')
            )->class('space-x-4')
		];
	}

    public function rules()
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
