<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
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
        // $setting = Setting::all();
        // if (auth()->user()) {
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Data has been getting successfully',
        //         'data' => $setting
        //     ]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validData = $request->validate([
        //     'country' => 'required',
        //     'temperature' => 'required',
        //     'degree_type' => 'required'
        // ]);
        // $setting = new Setting();
        // $setting->country = $validData['country'];
        // $setting->temperature = $validData['temperature'];
        // $setting->degree_type = $validData['degree_type'];

        // if ($setting->save()) {
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Data has been added successfully',
        //         'data' => $setting
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        // $validData = $request->validate([
        //     'country' => 'required',
        //     'temperature' => 'required',
        //     'degree_type' => 'required'
        // ]);
        // $setting = Setting::where('id', '=', $setting->id)->firstOrFail();
        // $setting->country = $validData['country'];
        // $setting->temperature = $validData['temperature'];
        // $setting->degree_type = $validData['degree_type'];

        // if ($setting->update()) {
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Data has been updated successfully',
        //         'data' => $setting
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
    }
}
