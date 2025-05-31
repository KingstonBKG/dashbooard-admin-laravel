<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userServices;

    public function __construct(UserServices $userService){
        $this->userServices = $userService;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard-analytics');
        }
        
        return view('pages.auth.auth-login');
    }

    public function logout(Request $request)
    {
        // Supprimer tous les tokens de l'utilisateur
        $request->user()->tokens()->delete();
        
        // Vider la session
        $request->session()->flush();
        
        // Déconnecter l'utilisateur
        // Auth::logout();

        // Rediriger vers la page de connexion
        return redirect()->route('auth-login');
    }
}
