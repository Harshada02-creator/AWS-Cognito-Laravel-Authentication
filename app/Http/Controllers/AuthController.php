<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CognitoService;

class AuthController extends Controller
{
    protected $cognito;

    public function __construct(CognitoService $cognito)
    {
        $this->cognito = $cognito;
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        try {
            $this->cognito->register(
                $request->name,
                $request->email,
                $request->password
            );

            return redirect('/verify')->with('email', $request->email);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function showVerify()
    {
        return view('verify');
    }

    public function verify(Request $request)
    {
        try {

            $this->cognito->verifyUser(
                $request->email,
                $request->code
            );

            return redirect('/login')->with('success', 'Email verified successfully!');

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());

        }
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {

            $result = $this->cognito->login(
                $request->email,
                $request->password
            );

            session([
                'access_token' => $result['AuthenticationResult']['AccessToken'],
                'id_token' => $result['AuthenticationResult']['IdToken'],
                'refresh_token' => $result['AuthenticationResult']['RefreshToken'],
                'email' => $request->email,
            ]);

            return redirect('/dashboard');

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());

        }
    }

    public function dashboard()
    {
        if (!session()->has('access_token')) {
            return redirect('/login');
        }

        return view('dashboard');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}