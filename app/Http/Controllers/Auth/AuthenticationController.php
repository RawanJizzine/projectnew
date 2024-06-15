<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{


    public function index(Request $request)

    {
        $showRegister = $request->get('showregister', false);

        return view('auth.index', ['showRegister' => $showRegister, 'toFront' => false]);
    }
    public function loginView(Request $request)

    {
        $showRegister = $request->get('showregister', false);

        return view('auth.index', ['toFront' => true]);
    }


    public function showRegisterView()

    {
        $planSelect = request('plan_id');
        $data['plan'] = $planSelect;

        return view('auth.register', $data);
    }
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('admin-data');
        }
        return redirect()->route('login')->with('error', 'Email or password is incorrect');
    }
    public function indexAdmin(Request $request)
    {

  return view('auth.indexAdmin',);
    } 
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'admin' ) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $user->update([
                'super_admin_setting' => 'yes',
            ]);

            return redirect()->route('admin-data');
        }
        return redirect()->route('login')->with('error', 'You are not the admin');
  
    }

    public function loginFront(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->put('reload', true);
           
         return redirect()->route('login-to-front');
        } else {

            return redirect()->route('login')->with('error', 'Email or password is incorrect');
        }
    }
    
    




    public function register(Request $request)
    {
        $plan = request('plan_id');



        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'terms' => 'accepted',
        ]);


        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),

        ]);


        Auth::login($user);
        return redirect()->route('payment-page')->with([
            'success' => 'Registration successful!',
            'plan_id' => $plan,
        ]);
    }

    public function logout()
    {
        $user_id = Auth::id();
        $user =  User::where('id', $user_id)->first();
        $user->update([
            'show_profile' => 'no',
        ]);

        auth()->logout();
        return redirect()->route('front-page');
    }
    public function logoutDashboard(Request $request)
    {
        $user_id = Auth::id();
        $user =  User::where('id', $user_id)->first();
         return redirect()->route('login-to-front');
       
    }
    public function logoutDashboardAdmin(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->update([
            'super_admin_setting' => 'no',
        ]);
         return redirect()->route('front-page');
       
    }
}
