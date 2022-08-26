<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\BraceletTracker;
use Illuminate\Http\Request;
use App\ClientSupervisor;
use DB;

class BraceletTrackerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $BraceletTracker = BraceletTracker::all();
        if (auth()->user()) {
            return response()->json([
                'status' => 1,
                'message_en' => 'Data has been getting successfully.',
                'message_ar' => 'تم جلب البيانات بنجاح.',
                'data' => $BraceletTracker
            ]);
        }
    }

    public function getLast60Ms($supervisor_id)
    {
        $client_id = ClientSupervisor::where('user_id', $supervisor_id)->value('client_id');

        if ($client_id) {
            $data = DB::table('users')
                ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
                ->join('bracelet_trackers', 'users.id', '=', 'bracelet_trackers.user_id')
                ->select('bracelet_trackers.user_id', 'users.name', 'users.braclet_id')
                ->where('client_employees.client_id', '=', $client_id)
                ->whereBetween('bracelet_trackers.created_at', [now()->subMinutes(60), now()])
                ->orderByDesc('temperature')
                ->get();

            if (count($data) == 0) {
                return response()->json([
                    'status' => 0,
                    'message_en' => 'No data insertion for bracelet tracker before 60 minutes.',
                    'message_ar' => 'لا يوجد بيانات مدخله مسبقاً للساعات قبل 60 دقيقة.',
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'message_en' => 'The last 60 minutes of insertion for bracelet tracker has been getting for successfully.',
                    'message_ar' => 'تم جلب البيانات المدخلة للساعات في آخر 60 دقيقة بنجاح.',
                    'data' => $data
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message_en' => 'Supervisor id not found.',
                'message_ar' => 'لم يتم العثور على بيانات المشرف.',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valideDate = $request->validate([
            'user_id' => 'required',
            'temperature' => 'required',
            'gps' => 'required',
            'gps_latitude' => 'required',
            'gps_longitude' => 'required',
            'heart_beat' => 'required',
            'oxygen_level' => 'required',
            'blood_pressure' => 'required',
        ]);
        $BraceletTracker = new BraceletTracker();
        $BraceletTracker->user_id = $valideDate['user_id'];
        $BraceletTracker->temperature = $valideDate['temperature'];
        $BraceletTracker->gps = $valideDate['gps'];
        $BraceletTracker->gps_latitude = $valideDate['gps_latitude'];
        $BraceletTracker->gps_longitude = $valideDate['gps_longitude'];
        $BraceletTracker->heart_beat = $valideDate['heart_beat'];
        $BraceletTracker->oxygen_level = $valideDate['oxygen_level'];
        $BraceletTracker->blood_pressure = $valideDate['blood_pressure'];

        if ($BraceletTracker->save()) {
            return response()->json([
                'status' => 1,
                'message_en' => 'Data has been added successfully',
                'message_ar' => 'تم إضافة البيانات بنجاح.',
                'data' => $BraceletTracker
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BraceletTracker  $BraceletTracker
     * @return \Illuminate\Http\Response
     */
    public function show(BraceletTracker $BraceletTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BraceletTracker  $BraceletTracker
     * @return \Illuminate\Http\Response
     */
    public function edit(BraceletTracker $BraceletTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BraceletTracker  $BraceletTracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BraceletTracker $BraceletTracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BraceletTracker  $BraceletTracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(BraceletTracker $BraceletTracker)
    {
        //
    }
}
