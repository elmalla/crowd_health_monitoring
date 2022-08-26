<?php

namespace App\Http\Controllers;

use App\BraceletEmployees;
use Illuminate\Http\Request;

class BraceletEmployeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','PTAdminRole','ClientSupervisornRole']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\BraceletEmployees  $braceletEmployees
     * @return \Illuminate\Http\Response
     */
    public function show(BraceletEmployees $braceletEmployees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BraceletEmployees  $braceletEmployees
     * @return \Illuminate\Http\Response
     */
    public function edit(BraceletEmployees $braceletEmployees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BraceletEmployees  $braceletEmployees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BraceletEmployees $braceletEmployees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BraceletEmployees  $braceletEmployees
     * @return \Illuminate\Http\Response
     */
    public function destroy(BraceletEmployees $braceletEmployees)
    {
        //
    }
}
