<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientType;
use App\User;
use App\ClientSupervisor;
use App\ClientEmployees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $clients = Client::all();
        $clienttypes = ClientType::all();
        return view('dashboard.client.clients', ['clients' => $clients, 'clienttypes' => $clienttypes]);
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
            'name_client' => 'required|min:3',
            'country_client' => ['required'],
            'city' => ['required'],
            'email_client' =>  ['required', 'email', 'max:255'],
            'phone_client' => 'required',
            'employee_total' => 'required',
            'clienttype_id' => 'required',
            'logo' => 'mimes:jpeg,jpg,png|max:1024',

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'national_id' => ['required', 'max:10', 'min:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required'],
            'nationality' => ['required'],
            'gender' => ['required'],
            'phone' => ['required'],
            'birth_date' => ['required'],
        ]);

        $client = new Client();
        $client->name = $validateData['name_client'];
        $client->country = $validateData['country_client'];
        $client->city = $validateData['city'];
        $client->email = $validateData['email_client'];
        $client->phone = $validateData['phone_client'];
        $client->employee_total = $validateData['employee_total'];

        if ($request['file']) {
            $imagePath = $request->file('file');
            $imageName = time() . '.' . $imagePath->getClientOriginalName();

            $path = $request->file('file')->storeAs('uploads/clientslogo', $imageName, 'public');
            $client->logo =  $path;
        }
        $client->website = $request['website'];
        $client->clienttype_id = $validateData['clienttype_id'];
        $clientsave = $client->save();

        $usersave = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'national_id' => $validateData['national_id'],
            'country' => $validateData['country'],
            'nationality' => $validateData['nationality'],
            'gender' => $validateData['gender'],
            'phone' => $validateData['phone'],
            'birth_date' => $validateData['birth_date'],
            // Role = ClientSupervisor: 2
            'role_id' => 2,
            'client_id' => $client->id,
            'braclet_id' => null
        ]);

        $clientSupervisor = new ClientSupervisor();
        $clientSupervisor->user_id = $usersave->id;
        $clientSupervisor->client_id = $client->id;
        // $clientSupervisorsave = $clientSupervisor->save();

        if ($clientsave and $usersave and $clientSupervisor->save()) {
            return back()->with('success', 'Add record has been successfully');
        } else {
            return $request->input();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function showSupervisors(Client $client)
    {
        $client_id = $client->id;
        $clientSupervisors = ClientSupervisor::select('user_id')->where('client_id', $client_id)->get();
        return view('dashboard.supervisor.supervisors', ['clientSupervisors' => $clientSupervisors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function showEmployees(Client $client)
    {
        $client_id = $client->id;
        $clientEmployees = ClientEmployees::where('client_id', $client_id)->get();
        return view('dashboard.employee.employees', ['clientEmployees' => $clientEmployees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
