<?php

namespace App\Http\Controllers\tontiflex\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use App\Notifications\LoginRequestNotification;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
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
        
        return view('pages.auth.auth-login');
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userServices->loginUser($request->email, $request->password);


        if (!$user) {
            return back()->withErrors([
                'email' => 'Les informations fournies ne correspondent pas à nos enregistrements.',
            ]);
        }

        Auth::login($user);


        // Créer le token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Stocker le token dans la session
        session(['auth_token' => $token]);

        $user = $this->userServices->getUser();

        $user = User::findOrFail($user->id);
        
        $user->notify(new LoginRequestNotification($user));
        

        return redirect()->route('dashboard-analytics');
    }
}
