<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AssginBraceletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function updateUserBracelete(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'braclet_id' => 'required',
        ]);
        $user_braclet_id = User::where('braclet_id', $validatedData['braclet_id'])->first();
        $user = User::findOrFail($validatedData['user_id']);

        if (!$user_braclet_id) {
            $user->braclet_id =  $validatedData['braclet_id'];
            if ($user->update()) {
                return response()->json([
                    'status' => 1,
                    'message_en' => 'The user assgin to bracelet successfully.',
                    'message_ar' => 'تم اسناد المستخدم للساعة بنجاح.',
                    'data' => $user
                ]);
            }
        } else {
            if ($user->braclet_id == $validatedData['braclet_id']) {
                return response()->json([
                    'status' => 0,
                    'message_en' => 'This user you already assigned to bracelet before.',
                    'message_ar' => 'هذا المستخدم تم اسناد له ساعة مسبقاً.',
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message_en' => 'This bracelet already assigned to another user.',
                    'message_ar' => 'تم اسناد هذه الساعة لمستخدم آخر مسبقاً.',
                ]);
            }
        }
    }
}
