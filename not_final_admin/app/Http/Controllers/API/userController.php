<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\GeneralMail;
use App\Mail\OtpEmail;
use App\Models\otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

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
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
        }
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                // Invalid credentials
                return $this->json_response('error', 'invalid_credential', 'The user email & password were incorrect.', 401);
            }
            $user = Auth::user();
            if ($user->status == 0) {
                return $this->json_response('error', 'email_verification_pending', 'Your verification is pending please verify your email', 200);
            }
            $token = $user->createToken('auth_api', ['*'])->accessToken;
            return $this->json_response('success', 'user_login', 'User login Successfully.', 200, $user, $token);
        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_create_token : ' . $e->getMessage(),'line'=>$e->getLine(),'file'=>$e->getFile()], 500);
        }
    }
    // This function for register users
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password', 'password_confirmation');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')],
            'password'  =>  ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'password_confirmation' => ['required_with:password', 'same:password', Password::min(8)]
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
        }
        try {
            $email = $request->input('email');
            $is_user = User::where('email', $email)->first();
            if (!empty($is_user)) {
                if ($is_user->status == 0) {
                    return $this->json_response('error', 'email verification pending', 'You are already register. Please verify your email', 200);
                }
                if ($is_user->status == 1) {
                    return $this->json_response('error', 'user_exist', 'You are already register.', 200);
                }
            }
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'status' => 2,
                'password' => Hash::make($request->input('password')),
            ]);
            $verifyUrl = URL::temporarySignedRoute('verification.verify',
                Carbon::now()->addMinutes(
                    Config::get('auth.verification.expire', 60)),
                [
                    'id' => $user->id,
                    'hash' => sha1($user->email),
                ]
                );
            $data=['url'=>$verifyUrl];
            Mail::to($request->input('email'))->send(new GeneralMail('verify_mail',$request->input('name'),$data));

            $token = $user->createToken('auth_api', ['*'])->accessToken;
            return $this->json_response('success', 'user created', 'User Created Successfully. Verification mail send to your provider email.', 200, $user, $token);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    public function verify($user_id, Request $request)
    {
        if (! $request->hasValidSignature()) {
            return $this->respondUnAuthorizedRequest(254);
        }
        $user = User::findOrFail($user_id);
        $user->status = 1;
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        $user->save();
        return redirect()->away('https://carryshipment.com/signin');
    }
    public function resend() {
        if (auth()->user()->hasVerifiedEmail()) {
            return $this->respondBadRequest(253);
        }

        $user = auth()->user();
        $verifyUrl = URL::temporarySignedRoute('verification.verify',
        Carbon::now()->addMinutes(
            Config::get('auth.verification.expire', 60)),
        [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]
        );
        $data=['url'=>$verifyUrl];
        Mail::to($user->email)->send(new GeneralMail('verify_mail',$user->name,$data));
        return $this->json_response('success', 'resed', 'Verification mail send to your provider email.', 200, $user, $token);
    }
    /*
        Description: This is function will used to send Otp to valid email for forgetPassword
    */
    function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);
        $email = $request->input('email');
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 200);
        }
        try {
            $user = User::where('email', $email)->first();

            if (!empty($user)) {
                $param['user_id'] = $user->id;
                $param['email'] = $user->email;
                $this->SendOTP($param);
                return $this->json_response('success', 'otp_sent', 'OTP has been sent to your registered email.', 200);
            } else {
                return $this->json_response('error', 'invalid_user', 'User not found against this email.', 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    public function SendOTP($param = [])
    {
        $user_id = $param['user_id'];
        $email = $param['email'];
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $otp = $randomString;
        $result = Otp::where('user_id', $user_id)->first();
        $expired_at = date("Y-m-d H:i:s", strtotime('+15 minutes'));

        otp::updateOrCreate(
            ['user_id' => $user_id],
            [
                'user_id' => $user_id,
                'otp' => $otp,
                'expired_at' => $expired_at,
            ]
        );
        // send OTP via email
        $data['otp'] = $otp;

        Mail::to($email)->send(new OtpEmail($data));
        return true;
    }
    public function verifyOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'otp' => 'required|numeric|digits_between:6,6',
            ]);

            if ($validator->fails()) {
                return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 200);
            }

            $email = $request->email;
            $user = User::where('email', $email)->first();
            if (empty($user)) {
                return $this->json_response('error', 'user_not_verified', "User not found against this email", 200);
            }
            $user_id = $user->id;
            $otp_response = Otp::where([
                'user_id' => $user_id,
                'otp' => $request->otp
            ])->first();

            if (!empty($otp_response)) {
                // check token expir time
                if ($otp_response->expired_at < date('Y-m-d H:i:s')) {
                    return $this->json_response('error', 'otp_expired', 'Your OTP has been expired. please generate again.', 401);
                } else {

                    return $this->json_response('success', 'valid_otp', "OTP is valid", 200);
                }
            } else {
                return $this->json_response('error', 'otp_invalid', 'Invalid OTP', 401);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    // change password by otp
    public function changePasswordOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits_between:6,6',
            'email' => 'required|email',
            'password'  =>  ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'password_confirmation' => ['required_with:password', 'same:password', Password::min(8)]

        ]);
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 400);
        }

        try {
            $user = User::where('email', $request->email)->first();
            if (!empty($user)) {
                $user_id = $user->id;
                $otp_response = Otp::where([
                    'user_id' => $user_id,
                    'otp' => $request->otp
                ])
                    ->first();
                if (!empty($otp_response)) {
                    // check token expir time
                    if ($otp_response->expired_at < date('Y-m-d H:i:s')) {
                        return $this->json_response('error', 'otp_expired', 'Your OTP has been expired. please generate again.', 401);
                    } else {
                        // change password here
                        $user_response = User::where('id', $user_id)->update(['password' => Hash::make($request->password)]);
                        return $this->json_response('success', 'password_change', 'Password has been changed Successfully.', 200);
                    }
                } else {
                    return $this->json_response('error', 'otp_invalid', 'Invalid OTP', 401);
                }
            } else {
                return $this->json_response('error', 'invalid_user', 'User not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    // change password by current password
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|numeric|digits_between:6,6',
            'password'  =>  ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'password_confirmation' => ['required_with:password', 'same:password', Password::min(8)]

        ]);
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 400);
        }

        try {
            $user = Auth::user();
            if (!empty($user)) {
                $user_id = $user->id;
                // check current password
                if (Hash::check($request->current_password, $user->password)) {
                    // change password here
                    $user_response = User::where('id', $user_id)->update(['password' => Hash::make($request->password)]);
                    return $this->json_response('success', 'password_change', 'Password has been changed Successfully.', 200);
                } else {
                    return $this->json_response('error', 'invalid_current_password', 'Your Curent password is Incorrect.', 401);
                }
            } else {
                return $this->json_response('error', 'invalid_user', 'User not found.', 404);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    // show loggedIn user profile
    public function profile()
    {
        try{
        $user_id = auth()->user()->id;
        $user = User::select('id','client_id','name', 'email', 'profile_img', 'address', 'contact_no', 'city', 'country')->find($user_id);
        return $this->json_response('success', 'profile_show', 'User Fetch Succeccfully', 200, $user);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }
    // update profile
    public function profileUpdate(Request $request)
    {
        $validateRule = [
            'name' => 'required|string',
            'address' => 'required|string|max:255',
            'contact_no' => 'required',
            'city' => 'required|string',
            'profile_image' => 'required|image|max:20480'
        ];
        $data = [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'contact_no' => $request->input('contact_no'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
        ];
        $validator = Validator::make($data, $validateRule);
        if ($validator->fails()) {
            return $this->json_response('error', 'validation_failed', $validator->errors()->first(), 422);
        }
        $user_id = Auth::user()->id;
        $file = $request->file('profile_image');
        if ($file) {
            $folderPath = "images/users";
            $imageName = time() . "." . $file->getClientOriginalExtension();
            Storage::disk('public')->put($folderPath . '/' . $imageName, file_get_contents($file));
            $storedImagePath = $folderPath . "/" . $imageName;
            // Create URL for the stored image
            $data['profile_img'] = asset('storage/' . $storedImagePath);
        }
        try {
            $profile_data = User::updateOrCreate(['id' => $request->user_id], $data);

            return $this->json_response('success', 'user_profile_update', 'User Profile Updated Successfully', 200, $profile_data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json(['message' => 'User logged out successfully']);
    }
}
