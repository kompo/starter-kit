<?php

namespace App\Kompo\Auth;

use Kompo\Form;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Auth\PasswordBroker;

class ForgotPasswordForm extends Form
{
    public $containerClass = 'container min-h-screen flex flex-col sm:justify-center items-center';
    public $class = 'sm:mx-auto sm:w-full sm:max-w-md';

    public function handle()
    {
        $status = $this->broker()->sendResetLink(
            request()->only('email')
        );

        return _Html($status)
            ->class('mb-4 font-medium text-sm p-4 rounded-lg')
            ->class($status == Password::RESET_LINK_SENT ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600');
    }


    public function komponents()
    {
        return [
            _Panel()->id('reset-password-response'),

            _Input('Email')->name('email'),
            
            _FlexEnd(
                _SubmitButton('Send Password Reset Link')
                    ->inPanel('reset-password-response')
            )
        ];
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
        ];
    }

    protected function broker(): PasswordBroker
    {
        return Password::broker(config('fortify.passwords'));
    }
}
