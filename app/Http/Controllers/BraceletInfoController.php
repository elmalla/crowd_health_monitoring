<?php

namespace App\Http\Controllers;

use App\BraceletInfo;

use Illuminate\Http\Request;

class BraceletInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'ClientSupervisornRole']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BraceletInfo  $braceletInfo
     * @return \Illuminate\Http\Response
     */
    public function show(BraceletInfo $braceletInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BraceletInfo  $braceletInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(BraceletInfo $braceletInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BraceletInfo  $braceletInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BraceletInfo $braceletInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BraceletInfo  $braceletInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BraceletInfo $braceletInfo)
    {
        //
    }
}
