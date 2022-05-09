<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    private $user;
    private $resetPassword;

    /**
     * UserController constructor.
     * @param User $user
     * @param PasswordReset $passwordReset
     */
    public function __construct(User $user, PasswordReset $passwordReset)
    {
        $this->user = $user;
        $this->resetPassword = $passwordReset;
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse|\Illuminate\Support\MessageBag
     */
    public function sendResetLink(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:password_resets',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $checkEmail = $this->user->getEmail($request);

        if ($checkEmail) {
            $hashString = Hash::make(getenv('PASSWORD_RESET_STRING'));

            $this->resetPassword->createResetPassword($checkEmail->email, $hashString);
            $token = $this->resetPassword->getByEmail($checkEmail->email);

            $link = $this->generateResetLink($token->token, $checkEmail->email);

            Mail::to($checkEmail->email)->send(new ResetPasswordMail($link));

            return response()->json(['message' => 'Link sent to email successfully'], 200);
        }

        return false;
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse|\Illuminate\Support\MessageBag
     */
    public function resetPassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'token' => 'required|string',
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        if (Hash::check(getenv('PASSWORD_RESET_STRING'), $request->get('token'))) {
            $this->resetPassword->deleteByEmail($request->get('email'));

            $this->user->updatePassword($request->get('email'), $request->get('password'));

            return response()->json(['message' => 'Password was successfully reset.'], 200);
        }

        return false;
    }
}
