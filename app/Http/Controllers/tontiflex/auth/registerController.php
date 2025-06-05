<?php

namespace App\Http\Controllers\tontiflex\auth;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Notifications\RegisterRequestNotification;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class registerController extends Controller
{
    private $userServices;

    public function __construct(UserServices $userService)
    {
        $this->userServices = $userService;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard-analytics');
        }
        return view('pages.auth.auth-register');
    }

    public function register(Request $request)
    {
        $user = $this->userServices->registerUser($request->all());
        $token = $user->createToken('auth_token')->plainTextToken;

        if (!$token) {
            return back()->withErrors([
                'email' => 'Les informations fournies ne correspondent pas à nos enregistrements.',
            ]);
        }

        $walletUser = Wallet::create([
            'user_id' => $user->id,
            'montant' => 0,
            'type' => 'solde principal',
            'is_active' => true,
        ]);

        if(!$walletUser) {
            return back()->withErrors([
                'wallet' => 'Une erreur est survenue lors de la création du portefeuille.',
            ]);
        }

        $user->sendEmailVerificationNotification();

        // Redirige vers la page de login avec un message
        return redirect()->route('auth-login')->with('message', 'Un email de vérification a été envoyé à votre adresse.');
    }
}
