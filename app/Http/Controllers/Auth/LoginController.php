<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return view('auth.login');
    }

    public function store(Request $request){
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => 'sometimes'
        ]);

        if (Auth::attempt($data, $request->remember)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return redirect(RouteServiceProvider::HOME)->withErrors([
            'status' => 'Credenciais inválidas.',
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        return back();
    }
}
