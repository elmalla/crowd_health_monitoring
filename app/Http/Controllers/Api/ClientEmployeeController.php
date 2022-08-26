<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ClientSupervisor;
use App\ClientEmployees;
use App\User;

class ClientEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        //
    }

    /* Display the specified resource.
    *
    */
    public function show($user_id)
    {
        $clientSupervisors = ClientSupervisor::where('user_id', $user_id)->first();

        if ($clientSupervisors) {
            $clientEmployees = ClientEmployees::where('client_id', $clientSupervisors->client_id)->get();

            foreach ($clientEmployees as $clientEmployee) {
                $employeesInfos = User::where('id', $clientEmployee->user_id)->get();
                foreach ($employeesInfos as $employeesInfo) {
                    $data[] = $employeesInfo;
                }
            }

            return response()->json([
                'status' => 1,
                'message_en' => 'Supervisor Employees info has been getting for successfully.',
                'message_ar' => 'تم جلب بيانات موظفي المشرف بنجاح.',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message_en' => 'Supervisor id not found.',
                'message_ar' => 'لم يتم العثور على بيانات المشرف.',
            ]);
        }
    }
}
