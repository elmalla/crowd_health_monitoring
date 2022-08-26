<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'PTAdminRole']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::paginate(10);
        return view('dashboard.setting.settings', ['settings' => $settings]);
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
        $validData = $request->validate([
            'country' => 'required',
            'temperature' => 'required',
            'degree_type' => 'required'
        ]);

        $setting = new Setting();
        $setting->country = $validData['country'];
        $setting->temperature = $validData['temperature'];
        $setting->degree_type = $validData['degree_type'];

        if ($setting->save()) {
            return back()->with('success', 'Add record has been successfully');
        } else {
            return $request->input();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        $setting = Setting::where('id', '=', $setting->id)->firstOrFail();
        return view('dashboard.setting.setting', ['setting' => $setting]);
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
        $validData = $request->validate([
            'country' => 'required',
            'temperature' => 'required',
            'degree_type' => 'required'
        ]);

        $setting = Setting::where('id', '=', $setting->id)->firstOrFail();
        $setting->country = $validData['country'];
        $setting->temperature = $validData['temperature'];
        $setting->degree_type = $validData['degree_type'];

        if ($setting->update()) {
            return back()->with('success', 'Data has been updated has been successfully');
        } else {
            return $request->input();
        }
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
