<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //
    public function homepage()
    {
        return view('Welcome');
    }

    public function login_page()
    {
        return view('Auth.Login');
    }

    public function register_page()
    {
        return view('Auth.Register');
    }

    public function Dashboard()
    {
        return view('Auth.Dashboard');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
       
        $data = $request->all();
        $email = $request->input('email');

        $check = $this->create($data);

        $data = "Thanks for Registering !";
    
        Mail::to($email)->send(new MailNotify($data));

        return redirect()->action([AuthController::class, 'login_page'])
            ->with('success', 'Registration successful! Please log in.');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            return redirect()->route('dashboard')->with('success', 'Login successful!');

        }


        return redirect()->action([AuthController::class, 'login_page'])->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->action([AuthController::class, 'login_page'])->with('success', 'Logout successful.');
    }
  
    //
    public function index()
    {
        $ids = User::pluck('id');
        return view('Auth.index', compact('ids'));
    }

    public function getDetails($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'name' => $user->name,
                'password' => $user->password,
            ]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
}
