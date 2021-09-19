<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Complain;
use Illuminate\Support\Facades\Session;

class ComplainController extends Controller
{
    public function allComplain(){
        Session::put('page','all-complain');
        $complains=DB::table('complain')
        ->join('department', 'complain.department_id', '=', 'department.department_id')
        ->join('employee', 'complain.employee_id', '=', 'employee.employee_id')
        ->join('designation', 'complain.designation_id', '=', 'designation.designation_id')
        ->select('complain.*', 'department.department_name as deptName', 'designation.designation_name as desigName','employee.first_name as employee_name')
        ->get();

        $count = Complain::where('status','=','1')->count();
        //dd($count);
        //dd($visitors);
        return view('backend.complain.all_complain')->with(compact('complains','count'));
    }

    public function deleteAll(Request $request){
        $ids = $request->complainId;
        foreach ($ids as $id){
            $complain = Complain::find($id);
            if ($complain){
                $complain->delete();
            }
        }
        return response()->json('success',201);
    }

    public function forwordAll(Request $request){
        $ids = $request->complainId;
        foreach ($ids as $id){
            $complain = Complain::find($id);
            if ($complain){
                $complain->status=1;
                $complain->save();
            }
        }
        return response()->json('success',201);
    }
}
