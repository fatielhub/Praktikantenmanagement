<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerifyPasswordResetCodeController extends Controller
{
    /**
     * Display the code verification view.
     */
    public function create(Request $request): View
    {
        return view('auth.verify-code', [
            'email' => $request->session()->get('email'),
        ]);
    }

    /**
     * Verify the reset code.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
            'email' => ['required', 'email'],
        ]);

        $resetCode = PasswordResetCode::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$resetCode || !$resetCode->isValid()) {
            return back()->withInput($request->only('email'))
                ->withErrors(['code' => 'Code invalide ou expiré.']);
        }

        return redirect()->route('password.reset')
            ->with('email', $request->email)
            ->with('code', $request->code);
    }
}
