<?php

namespace App\Kompo\Auth;

use App\Kompo\Auth\RegisterForm;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Kompo\Form;
use Laravel\Fortify\Fortify;

class ResetPasswordForm extends Form
{
    public $containerClass = 'container min-h-screen flex flex-col sm:justify-center items-center';
    public $class = 'sm:mx-auto sm:w-full sm:max-w-md';

    protected $token;

    public function created()
    {
        $this->token = $this->prop('token');
    }

    public function handle()
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = $this->broker()->reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {

                $user->forceFill([
                    'password' => Hash::make(request('password')),
                ])->save();

                $user->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', trans($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($this->status)],
        ]);
    }

	public function komponents()
	{
		return [
			_Hidden('token')->value($this->token),
            _Input('Email')->name('email')->value(request('email')),
            _Password('Password')->name('password'),
            _Password('Password Confirmation')->name('password_confirmation'),
			_FlexEnd(
                _SubmitButton('Reset Password')
            )
		];
	}

    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => RegisterForm::passwordRules(),
        ];
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker(config('fortify.passwords'));
    }
}
