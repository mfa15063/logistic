<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\error;

/*
    Author      : Zeeshan Mushtaq
    Date        : 10-12-2023
    Description : This  class will manage user authentication.
*/

class UserController extends Controller
{
    // This function for authentication / login
    public function authenticate(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $request->validate(
            [
                'email' => ['required', 'email', 'exists:users,email'],
                'password'  =>  ['required', Password::min(8)]
            ],
            [
                'email.exists' => 'The  email is invalid.'
            ]
        );
        $remember = $request->has('remember') ? true : false;
        // dd($remember);
        if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']), $remember)) {
            if (Auth::check() && Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login')->withErrors([
                    'error' => 'You not allow to access administrator panel',
                ])->withInput();
            }
        } else {
            return redirect()->route('admin.login')->withErrors([
                'password' => 'The password is invalid.',
            ])->withInput();
            // ->withInput();
        }
    }
    //
    // update profile
    public function profile(Request $request)
    {
        $request->validate(
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]
        );
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login'); // Redirect to your desired page after logout
    }
}
