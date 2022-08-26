<?php

namespace App\Http\Controllers;

use App\BraceletType;
use Illuminate\Http\Request;

class BraceletTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','PTAdminRole']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $braceletTypes = BraceletType::paginate(10);
        return view('dashboard.bracelet.bracelettypes', ['bracelettypes' => $braceletTypes]);
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
            'vendor_name' => 'required|min:3',
        ]);

        $braceletType = new BraceletType();
        $braceletType->vendor_name = $valideDate['vendor_name'];

        if ($braceletType->save()) {
            return back()->with('success', 'Add record has been successfully');
        } else {
            return $request->input();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BraceletType  $braceletType
     * @return \Illuminate\Http\Response
     */
    public function show(BraceletType $braceletType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BraceletType  $braceletType
     * @return \Illuminate\Http\Response
     */
    public function edit(BraceletType $braceletType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BraceletType  $braceletType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BraceletType $braceletType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BraceletType  $braceletType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BraceletType $braceletType)
    {
        //
    }
}
