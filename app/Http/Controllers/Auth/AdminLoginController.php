<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    private $errors= [];
    protected $redirectTo = '/dashboard';

    public function showLoginForm(){
        return view('backend.auth.login');
    }

    /**
     * Override
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function visitor_login_check(Request $request)
    {

        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $auth = User::where('user_name','=', $request->user_name)->first();
        if ($auth) {
            if (Hash::check($request->password, $auth->password)) {
                session([
                     'user_id' =>$auth->user_id,
                     'user_name' =>$auth->user_name,
                     'role_id' =>$auth->role_id,
                ]);
                //dd(session()->get());
                if ($auth->role_id == 1) {
                    return redirect('/dashboard');
                }elseif ($auth->role_id == 9) {
                    return redirect('/dashboard');
                }else{
                    return redirect('/visitor-login');
                }

            }else{
                return redirect('/visitor-login')
                ->withInput($request->only('user_name'))
                ->withErrors($this->errors);
            }
        }else{
            return back()->with('failed','No Account For This Email');
        }
    }
    

    protected function guard()
    {
        return Auth::guard('guest');
    }
    /**
     * Override
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
