<?php

namespace App\Http\Controllers;

use App\BraceletTracker;
use Illuminate\Http\Request;

class BraceletTrackerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'ClientSupervisornRole']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bracelet.bracelettracker');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BraceletTracker  $braceletTracker
     * @return \Illuminate\Http\Response
     */
    public function show(BraceletTracker $braceletTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BraceletTracker  $braceletTracker
     * @return \Illuminate\Http\Response
     */
    public function edit(BraceletTracker $braceletTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BraceletTracker  $braceletTracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BraceletTracker $braceletTracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BraceletTracker  $braceletTracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(BraceletTracker $braceletTracker)
    {
        //
    }
}
