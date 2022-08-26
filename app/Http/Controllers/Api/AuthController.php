<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\ClientSupervisor;
use App\Setting;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'national_id' => 'required|unique:users|min:10|max:10',
            'country' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'phone' => 'required|min:10|unique:users',
            'birth_date' => 'required',
            'role_id' => 'required',
            'mobile_id' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        if ($user) {
            return response()->json([
                'status' => 1,
                'message_en' => 'The user account has been created successfully',
                'message_ar' => 'تم إنشاء حساب المستخدم بنجاح.',
                'data' => $user
            ]);
        }
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
            // 'mobile_id' => 'unique:users'
        ]);

        // if (!auth()->attempt($validatedData)) {
        //     return response()->json([
        //         'status' => 0,
        //         'message_en' => 'Invalid login details, Please Try again.',
        //         'message_ar' => 'تفاصيل بيانات تسجيل الدخول غير صحيحة، يرجى إعادة المحاولة مجدداً.'
        //     ]);
        // }

        $user = User::where('email', $validatedData['email'])->first();

        $clientSupervisorinfo = ClientSupervisor::select('client_id')->where('user_id', $user->id)->first();
        $clientCountry = Client::select('country')->where('id', $clientSupervisorinfo->client_id)->first();
        $setting = Setting::where('country', $clientCountry->country)->first();

        if ($user->mobile_id) {
            $accessToken = $user->createToken('authToken')->accessToken;

            if ($user->mobile_id ==  $request['mobile_id']) {
                return response()->json([
                    'status' => 1,
                    'message_en' => 'User has been logged in successfully.',
                    'message_ar' => 'تم تسجيل دخول المستخدم بنجاح.',
                    'data' => [
                        'accessToken' => $accessToken,
                        'userInfo' => $user,
                        'setting' => $setting
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message_en' => 'You already registered at another mobile, kindly contact with admin.',
                    'message_ar' => 'أنت مسجل بالفعل على هاتف محمول آخر ، يرجى التواصل مع مدير النظام.',
                ]);
            }
        } else {
            $user->mobile_id =  $request['mobile_id'];
            $accessToken = $user->createToken('authToken')->accessToken;
            if ($user->update()) {
                return response()->json([
                    'status' => 1,
                    'message_en' => 'User has been updated mobile id and login successfully.',
                    'message_ar' => 'تم تحديث معرف الهاتف المحمول للمستخدم وتسجيل الدخول بنجاح',
                    'data' => [
                        'accessToken' => $accessToken,
                        'userInfo' => $user,
                        'setting' => $setting
                    ]
                ]);
            }
        }
    }
}
