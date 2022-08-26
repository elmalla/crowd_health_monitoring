<?php

namespace App\Http\Controllers;

use App\ClientType;
use Illuminate\Http\Request;

class ClientTypeController extends Controller
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
        $clienttypes = ClientType::paginate(10);
        return view('dashboard.client.clienttypes', ['clienttypes' => $clienttypes]);
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
            'type_name' => 'required|min:3',
        ]);

        $ClientType = new ClientType();
        $ClientType->type_name = $valideDate['type_name'];

        if ($ClientType->save()) {
            return back()->with('success', 'Add record has been successfully');
        } else {
            return $request->input();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function show(ClientType $clientType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientType $clientType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientType $clientType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientType $clientType)
    {
        //
    }
}
