<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use App\Models\VerificationCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{

    public function signUp(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'name' => 'required|min:3',
            'mobile_no' => 'required|min:8|max:13',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201,'message' => implode("\n", $validator->messages()->all())]);
        }
        DB::beginTransaction();
        try {
            $user =  new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->password = Hash::make($request->password);
            $done = $user->save();
            if($done){
                $verificationCode = rand(1000, 9999);
                $code = new VerificationCode();
                $code->email = $user->email;
                $code->mobile_no = $user->mobile_no;
                $code->code = $verificationCode;
                $code->save();
            }

            dispatch(function () use ($user,$verificationCode) {
                $subject = 'WELCOME TO OPEN MARKET' ;
                $blade_data = array(
                    'subject'=> $subject,
                    'user'=>$user,
                    'verificationCode'=>$verificationCode,
                );
                $email_data = array(
                    'from' => env('MAIL_FROM_ADDRESS'),
                    'fromName' => env('MAIL_FROM_NAME'),
                    'to' => [$user->email]);
                try{
                    Mail::send('emails.user$userEmail', $blade_data, function ($message) use ($email_data, $subject) {
                        $message->to($email_data['to'])
                                ->subject($subject)
                                ->replyTo($email_data['from'], $email_data['fromName'])
                                ->from($email_data['from'],$email_data['fromName']);
                    });
                }
                catch(Exception $e) {
                }

            })->afterResponse();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 403);
        }
        return response()->json(['status' => true, 'code' => 200, 'message' => 'ok', 'user' => $user]);
          
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $conditions = ['email' => $request->email, 'password' => $request->password];
        } else {
            $conditions = ['mobile_no' => $request->email, 'password' => $request->password];
        }

        if (Auth::once($conditions)) {
            $user = Auth::user();
            if ($user->verified == 0) {
                $code = new VerificationCode();
                $code->mobile_no = $user->mobile_no;
                $code->email = $user->email;
                $code->code = 1111;
                $code->save();
                $message = 'Must Verified Email';
                return response()->json(['status' => true, 'code' => 210, 'message' => $message]);
            }
            else {
                $user['access_token'] = $user->createToken('mobile_no')->accessToken;
                return response()->json(['status' => true, 'code' => 200, 'user' => $user]);
            }
        } else {

            $EmailData = User::query()->where(['email' => $email])->first();
            if ($EmailData) {
                $message = __('wrong password');

                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);

            } else {
                $message = __('wrong email');

                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
            }
        }
    }
    public function sendCodeToApi(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $code = convertAr2En($request->code);
        $validationCode = new VerificationCode;
        $validationCode->mobile_no = $request->mobile_no;
        $validationCode->code = $request->code;
        $validationCode->save();
        return response()->json(['status' => false, 'code' => 200, 'message' => 'ok']);
       
    }
    public function verifyCode(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required',
            'code' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 201,
                'message' => implode("\n", $validator->messages()->all())]);
        } 

        $code = convertAr2En($request->code);
        $item = VerificationCode::where('mobile_no', $request->mobile_no)
        ->where('code', $code)
        ->orderBy('created_at', 'desc')
        ->first();
        if ($item) {
            if ($code == $item->code) {
                $item->delete();
                $user = User::where('mobile_no', $request->mobile_no)->first();
                if ($user) {
                    $user->verified = 1;
                    $user->status = 'active';
                    $user->save();
                    Auth::login($user);
                     if ($request->has('fcm_token')) {
                        Token::updateOrCreate(['device_type' => $request->get('device_type'), 'fcm_token' => $request->get('fcm_token'), 'lang' => app()->getLocale()]
                        , ['user_id' => $user->id]);
                    }
                    $user['access_token'] = $user->createToken('mobile_no')->accessToken;
                $massege = __('ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $massege, 'user' => $user]);
                }
            } else {
                $massege = __('incorrect code');
                return response()->json(['status' => false, 'code' => 200, 'message' => $massege]);
            }

        } else {
            $massege = __('incorrect code');
            return response()->json(['status' => false, 'code' => 200, 'message' => $massege]);

        }
    }

    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $user = User::where('mobile_no', $request->mobile_no)->first();
        if (!$user) {
            $message = 'The mobile number not found';
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
        // $token = $this->broker()->createToken($user);
        // $url = url('/password/reset/' . $token);
        // $user->notify(new ResetPassword($token));
        $message = __('reset Password');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }

    public function changePassword(Request $request){
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $user = auth('api')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $message = __('old_password'); //wrong old
            return response()->json(['status' => false, 'code' => 200, 'message' => $message,
                'validator' => $validator]);
        }

        $user->password = Hash::make($request->password);

        if ($user->save()) {
            $user->refresh();
            $message = __('ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
        $message = __('whoops');
        return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }

    public function logout(Request $request){
        $user_id = auth('api')->id();
        Token::where('fcm_token', $request->fcmToken)->delete();
        if (auth('api')->user()->token()->revoke()) {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 200,
                'message' => $message]);
        } else {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 202,
                'message' => $message]);
        }
    }
    
}

