<?php

namespace App\Http\Controllers;

use App\ClientSupervisor;
use App\ClientEmployees;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientSupervisorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','ClientSupervisornRole']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_id = Auth::user()->clientSupervisor()->first()->client_id;
        $clientSupervisors = ClientSupervisor::where('client_id', $client_id)->get();
        $clientEmployees = ClientEmployees::where('client_id', $client_id)->get();
        return view('dashboard.supervisor.supervisors', ['clientSupervisors' => $clientSupervisors, 'clientEmployees' => $clientEmployees]);
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
        $client_id = Auth::user()->clientSupervisor()->first()->client_id;
        $valideDate = $request->validate([
            'user_id' => 'required',
        ]);

        $ClientSupervisor = new ClientSupervisor();
        $ClientSupervisor->user_id = $valideDate['user_id'];
        $ClientSupervisor->client_id = $client_id;

        $user_id = $request['user_id'];

        $clientEmployee = ClientEmployees::where('user_id', $user_id)->delete();

        $userRole = User::where('id', $user_id)
        ->update(['role_id' => 2]);

        if ($ClientSupervisor->save() AND $clientEmployee AND $userRole) {
            return back()->with('success', 'Add record has been successfully');
        } else {
            return $request->input();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientSupervisor  $clientSupervisor
     * @return \Illuminate\Http\Response
     */
    public function show(ClientSupervisor $clientSupervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientSupervisor  $clientSupervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientSupervisor $clientSupervisor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientSupervisor  $clientSupervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientSupervisor $clientSupervisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientSupervisor  $clientSupervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientSupervisor $clientSupervisor)
    {
        //
    }
}
