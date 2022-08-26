<?php

namespace App\Http\Controllers;

use App\ClientEmployees;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientEmployeeController extends Controller
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
        $client_id = Auth::user()->clientSupervisor()->first()->client_id;
        $clientEmployees = ClientEmployees::where('client_id', $client_id)->get();
        return view('dashboard.employee.employees', ['clientEmployees' => $clientEmployees]);
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
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'national_id' => ['required', 'max:10', 'min:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nationality' => ['required'],
            'country' => ['required'],
            'gender' => ['required'],
            'phone' => ['required'],
            'birth_date' => ['required'],
        ]);

        $usersave = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'national_id' => $validateData['national_id'],
            'nationality' => $validateData['nationality'],
            'country' => $validateData['country'],
            'gender' => $validateData['gender'],
            'phone' => $validateData['phone'],
            'birth_date' => $validateData['birth_date'],
            // Role = ClientEmployee: 3
            'role_id' => 3,
        ]);

        $clientEmployees = new ClientEmployees();
        $clientEmployees->user_id = $usersave->id;
        $clientEmployees->client_id = Auth::user()->clientSupervisor()->first()->client_id;
        $clientEmployeessave = $clientEmployees->save();

        if ($usersave and $clientEmployeessave) {
            return back()->with('success', 'Add record has been successfully');
        } else {
            return $request->input();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientEmployees  $clientEmployees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = $id;
        $employeeInfo = User::where('id',  $user_id)->first();
        return view('dashboard.employee.employee', ['employeeInfo' => $employeeInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientEmployees  $clientEmployees
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientEmployees $clientEmployees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientEmployees  $clientEmployees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientEmployees $clientEmployees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientEmployees  $clientEmployees
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientEmployees $clientEmployees)
    {
        //
    }
}
