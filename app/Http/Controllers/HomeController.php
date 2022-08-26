<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\ClientSupervisor;
use App\ClientEmployees;
use App\BraceletTracker;
use App\GotCovid;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('ClientAdminRole' , ['except' => ['index', 'profile']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->isClientSupervisor()) {
            $client_id = Auth::user()->clientSupervisor()->first()->client_id;

            $totalRegisteredEmployee = ClientEmployees::where('client_id', $client_id)->count();

            $settings = DB::table('settings')
                ->join('clients', 'settings.country', '=', 'clients.country')
                ->select('settings.temperature', 'settings.degree_type')
                ->where('clients.id', $client_id)
                ->get();
            $temperatureCountry = "";
            $degreeTypeCountry = "";
            foreach ($settings as $setting) {
                $temperatureCountry = $setting->temperature;
                $degreeTypeCountry = $setting->degree_type;
            }

            $employees = ClientEmployees::where('client_id', $client_id)->get();

            $totalEmployeeNotRegisterBracelets = 0;
            $totalEmployeeScannedToday = 0;
            $totalEmployeeScannedYesterday = 0;

            foreach ($employees as $employee) {
                // totalEmployeeNotRegisterBracelets
                $users = User::where([
                    ['id', $employee->user_id],
                    ['braclet_id', '=', null]
                ])->count();

                if ($users > 0) {
                    $totalEmployeeNotRegisterBracelets++;
                }

                //totalEmployeeScannedToday
                $users2 = BraceletTracker::where([
                    ['user_id', $employee->user_id],
                    ['created_at', 'like', '%' . date('Y-m-d') . '%']
                ])->count();

                if ($users2 > 0) {
                    $totalEmployeeScannedToday++;
                }

                // totalEmployeeScannedYesterday
                $users3 = BraceletTracker::where([
                    ['user_id', $employee->user_id],
                    ['created_at', 'like', '%' . date('Y-m-d', strtotime("yesterday")) . '%']
                ])->count();

                if ($users3 > 0) {
                    $totalEmployeeScannedYesterday++;
                }
            }
            // highesttemperatureToday
            $employeesHighestTemperatureToday = DB::table('users')
                ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
                ->join('bracelet_trackers', 'users.id', '=', 'bracelet_trackers.user_id')
                ->select('users.*', 'bracelet_trackers.*')
                ->where([
                    ['bracelet_trackers.created_at', 'like', '%' . date('Y-m-d') . '%'],
                    ['client_employees.client_id', '=', $client_id],
                    // ['temperature', '>=', $temperatureCountry]
                    ['temperature', '>=', '37.9']
                ])
                ->orderByDesc('temperature')
                ->get();

            // LowtemperatureToday
            $employeesLowTemperatureToday = DB::table('users')
                ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
                ->join('bracelet_trackers', 'users.id', '=', 'bracelet_trackers.user_id')
                ->select('users.*', 'bracelet_trackers.*')
                ->where([
                    ['bracelet_trackers.created_at', 'like', '%' . date('Y-m-d') . '%'],
                    ['client_employees.client_id', '=', $client_id],
                    // ['temperature', '<', $temperatureCountry]
                    ['temperature', '<', '37.9']
                ])
                ->orderByDesc('temperature')
                ->get();

            return view('dashboard.home', [
                'totalRegisteredEmployee' => $totalRegisteredEmployee,
                'totalEmployeeNotRegisterBracelets' => $totalEmployeeNotRegisterBracelets,
                'totalEmployeeScannedToday' => $totalEmployeeScannedToday,
                'totalEmployeeScannedYesterday' => $totalEmployeeScannedYesterday,
                'employeesHighestTemperatureToday' => $employeesHighestTemperatureToday,
                'employeesLowTemperatureToday' => $employeesLowTemperatureToday,
            ]);
        } elseif (Auth::user()->isPTAdmin()) {

            // TOTAL OF HIGHEST TEMPERATURE / TOTAL OF WHO IS GOT COVID
            $employeesHighestTemperatureMonthly = array();
            $employeesGotCovidMonthly = array();

            for ($i = 1; $i <= 12; $i++) {
                $data =  BraceletTracker::groupBy(
                    DB::raw('MONTH(created_at)')
                )->where(DB::raw('MONTH(created_at)'), '=', $i)->count();
                $employeesHighestTemperatureMonthly[] = $data;

                $data2 =  GotCovid::groupBy(
                    DB::raw('MONTH(created_at)')
                )->where(DB::raw('MONTH(created_at)'), '=', $i)->count();
                $employeesGotCovidMonthly[] = $data2;
            }

            // TOTAL OF SCANNED FOR EVERY CLIENT
            $clientsNames = Client::all()->pluck('name');
            // $clientsIDs = Client::all()->pluck('id');

            // foreach ($clientsIDs as $clientsID) {
            //     $clientsTotalscnnned = DB::table('users')
            //         ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
            //         ->join('bracelet_trackers', 'users.id', '=', 'bracelet_trackers.user_id')
            //         ->select('users.*', 'bracelet_trackers.*')
            //         ->where([
            //             [(DB::raw('MONTH(bracelet_trackers.created_at)')), 'like', '%' . date('m') . '%'],
            //             ['client_employees.client_id', '=', $clientsID],
            //         ])
            //         ->count();
            // }

            return view('dashboard.home', [
                'employeesHighestTemperatureMonthly' => $employeesHighestTemperatureMonthly,
                'employeesGotCovidMonthly' => $employeesGotCovidMonthly,
                'clientsNames' => $clientsNames,
            ]);
        }
        return view('dashboard.home');
    }


    public function employeeNotRegisterBracelets()
    {
        if (Auth::user()->isClientSupervisor()) {
            $client_id = Auth::user()->clientSupervisor()->first()->client_id;

            $clientEmployees = DB::table('users')
                ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
                ->select('users.*')
                ->where([
                    ['users.braclet_id', '=', NULL],
                    ['client_employees.client_id', '=', $client_id]
                ])
                ->get();

            return view('dashboard.employee.employees-not-register-bracelets', [
                'clientEmployees' => $clientEmployees,
            ]);
        }
    }

    public function employeeScannedToday()
    {
        if (Auth::user()->isClientSupervisor()) {
            $client_id = Auth::user()->clientSupervisor()->first()->client_id;

            $clientEmployees = DB::table('users')
                ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
                ->join('bracelet_trackers', 'users.id', '=', 'bracelet_trackers.user_id')
                ->select('users.*', 'bracelet_trackers.*')
                ->where([
                    ['bracelet_trackers.created_at', 'like', '%' . date('Y-m-d') . '%'],
                    ['client_employees.client_id', '=', $client_id]
                ])
                ->get();

            return view('dashboard.employee.employees-scanned', [
                'clientEmployees' => $clientEmployees
            ]);
        }
    }

    public function employeeScannedYesterday()
    {
        if (Auth::user()->isClientSupervisor()) {
            $client_id = Auth::user()->clientSupervisor()->first()->client_id;

            $clientEmployees = DB::table('users')
                ->join('client_employees', 'users.id', '=', 'client_employees.user_id')
                ->join('bracelet_trackers', 'users.id', '=', 'bracelet_trackers.user_id')
                ->select('users.*', 'bracelet_trackers.*')
                ->where([
                    ['bracelet_trackers.created_at', 'like', '%' . date('Y-m-d', strtotime("yesterday")) . '%'],
                    ['client_employees.client_id', '=', $client_id]
                ])
                ->get();

            return view('dashboard.employee.employees-scanned', [
                'clientEmployees' => $clientEmployees
            ]);
        }
    }

    public function profile()
    {
        return view('profile.profile');
    }
}
