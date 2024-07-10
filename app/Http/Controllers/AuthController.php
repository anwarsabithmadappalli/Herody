<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email|max:200|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:6|max:16',
        ],[
            'email.required' => 'Please enter the email.',
            'email.email' => 'Invalid email.',
            'password.required' => 'Please enter the password.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'User logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid password')->withInput();
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $fields    = $request->input();
        $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|max:100',          
                'email'  => 'nullable|unique:users,email|email|max:200|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'password'    => 'required|min:6|max:16',
                'password_confirmation' => 'required|same:password|min:6|max:16'

        ],[
            'name.required' => 'Please enter the name.',
            'password.required' => 'Please enter the password.',
            'password_confirmation.required'=>'Please enter the confirmation password.',
            'password_confirmation.same' => 'Entered password and confirmation password should be same.',
        ]);

        if ($validator->fails()) 
        {
            $errors = collect($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else
        {

            $user = new User();
            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->password = bcrypt($fields['password']);
            $user->user_id = uniqid('usr_');
            if($user->save())
            {
                auth()->login($user);
                return redirect()->route('dashboard')->with('success', 'User registered successfully');
            }else{
                return response()->json(false, $data = [],$message ='Failed to register user!', 400);
            }


        }  
    }
    public function home()
    {
        return view('welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully');
    }
}

