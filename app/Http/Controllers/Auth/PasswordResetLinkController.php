<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetCode;
use App\Models\User;
use App\Notifications\PasswordResetCodeNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Check if user exists and is admin
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Aucun compte trouvé avec cet email.']);
        }

        if ($user->role !== 'admin') {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Seuls les administrateurs peuvent réinitialiser leur mot de passe.']);
        }

        // Generate and send code
        $code = PasswordResetCode::generateCode($request->email);
        $user->notify(new PasswordResetCodeNotification($code));

        return redirect()->route('password.verify-code')
            ->with('status', 'Un code de vérification a été envoyé à votre adresse email.')
            ->with('email', $request->email);
    }
}
