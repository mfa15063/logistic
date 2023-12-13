<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        // dd($request);
        $user = User::findorFail(auth()->user()->id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($file = $request->hasFile('profile_img')) {
                $file = $request->file('profile_img');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path() . '/admin/img/profile';
                $file->move($destinationPath, $fileName);
                $user->profile_img = $fileName;
            }
            $user->update();
        } else {
            echo 'undefined';
        }
        return redirect()->back();
    }
    // change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'  =>  ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'password_confirmation' => ['required_with:password', 'same:password', Password::min(8)]
        ]);

        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password changed successfully');
        }

        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login'); // Redirect to your desired page after logout
    }
}
