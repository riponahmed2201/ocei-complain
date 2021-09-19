<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Complain;
use DB;

class ComplainController extends Controller
{
    public function showComplainForm(){
        $departments=DB::table('department')->get();
        $designations=DB::table('designation')->get();
        $employees=DB::table('employee')->get();
        return view('frontend.complain.complain')->with(compact('departments','designations','employees'));
    }

    public function storeComplain(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'mobile'=>'required|min:11|numeric',
            'designation_id'=>'required',
            'employee_id'=>'required',
            'department_id'=>'required',
            'reason'=>'required'
            ]);
             
             $complain=new Complain;
             $complain->name=$data['name'];
             $complain->mobile=$data['mobile'];
             $complain->designation_id=$data['designation_id'];
             $complain->department_id=$data['department_id'];
             $complain->employee_id=$data['employee_id'];
             $complain->reason=$data['reason'];
             $complain->status=0;
             if(!empty($request->input('gender'))) {
                    $complain->gender = $request->gender;
                } else {
                    $complain->gender = 'Null';
             }
              if(!empty($request->input('email'))) {
                    $complain->email = $request->email;
                } else {
                    $complain->email = 'Null';
             }
             $complain->save();
             return redirect()->back()->with('success','Successfully Complain Data Inserted!');
        }
    }
}
