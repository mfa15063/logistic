<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use League\OAuth2\Server\Exception\OAuthServerException;

/*
    Author      : Zeeshan Mushtaq
    Date        : 04-12-2023
    Description : This  class will manage user authentication.
*/

class userController extends Controller
{
    // This function for authentication / login
    public function authenticate(Request $request)
    {
        //Validate data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password'  =>  ['required', Password::min(8)]
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
        }

        try {
            $credentials = $request->only('email', 'password');
            $remember = request()->has('remember'); // Check if "remember" checkbox is checked

            if (!Auth::attempt($credentials, $remember)) {
                // Invalid credentials
                throw new OAuthServerException('The user credentials were incorrect.', 6, 'invalid_credentials', 401);
            }
            $user = Auth::user();
            $token = $user->createToken('auth_api', ['*'])->accessToken;
            return $this->json_response('success', 'user_login', 'User login Successfully.', 200, $user, $token);
        } catch (OAuthServerException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }
    // This function for register users
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password_confirmation', 'password');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password'  =>  ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'password_confirmation' => ['required_with:password', 'same:password', Password::min(8)]
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
        }
        try {
            $data = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            // show created user
            return $this->json_response('success', 'user_created', 'User Created Successfully', 200, $data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    // show logedin user
    public function self()
    {
        $user = Auth::user();
        return $this->json_response('success', 'user_show', 'User Fetch Succeccfully', 200, $user);
    }
}
