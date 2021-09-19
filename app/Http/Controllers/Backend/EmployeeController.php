<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function forwardingComplain(){
        Session::put('page','forwar-complain');
        $employee_id = session('user_id');
        //dd($employee_id);
        $forwardingComplains=DB::table('complain')
        ->join('department', 'complain.department_id', '=', 'department.department_id')
        ->join('employee', 'complain.employee_id', '=', 'employee.employee_id')
        ->join('designation', 'complain.designation_id', '=', 'designation.designation_id')
        ->select('complain.*', 'department.department_name as deptName', 'designation.designation_name as desigName','employee.first_name as employee_name')
        ->where('complain.status', '=', 1)
        ->where('employee.user_id', '=', $employee_id)
        ->get();
        //dd($forwardingVisitors);
        return view('backend.employee.all_forwar_complainer')->with(compact('forwardingComplains'));
    }
}
