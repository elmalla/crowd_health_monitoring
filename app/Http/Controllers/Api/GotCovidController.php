<?php

namespace App\Http\Controllers\Api;

use App\GotCovid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GotCovidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'user_id' => 'required',
            'covid' => 'required'
        ]);

        $getCovid = new GotCovid();
        $getCovid->user_id = $validData['user_id'];
        $getCovid->covid = $validData['covid'];

        if ($getCovid->save()) {
            return response()->json([
                'status' => 1,
                'message_en' => 'Data has been added successfully',
                'message_ar' => 'تم جلب البيانات بنجاح.',
                'data' => $getCovid
            ]);
        }
    }
}
