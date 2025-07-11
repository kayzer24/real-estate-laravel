<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request):RedirectResponse
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.property.index'));
        }

        return back()
            ->withErrors([
                'email' => 'Identifiants invalides',
                'password' => 'Identifiants invalides',
            ])
            ->onlyInput('email');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return to_route('login')
            ->with('success', 'Vous etes maintenant déconnecté');
    }
}
