<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:1|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function login(Request $request) {
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($user)) {
            return redirect()->route("dashboard");
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout() {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect("/");
    }

    public function removeAccount() {
        $user = Auth::user();

        if ($user) {
            $user->delete();

            Auth::logout();

            return redirect('/')->with("success", "Compte supprimé avec succès", 200);
        }

        return redirect("/")->with("error", "Utilisateur non trouvé", 404);
    }
}
