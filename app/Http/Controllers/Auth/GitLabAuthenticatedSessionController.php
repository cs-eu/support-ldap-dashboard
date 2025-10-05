<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GitLabAuthenticatedSessionController extends Controller
{
    /**
     * Redirect to GitLab
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function create()
    {
        return Socialite::driver('gitlab')->redirect();
    }

    /**
     * Handle an incoming authentication request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // ensure user was able to authenticate with GitLab
        $user = Socialite::driver('gitlab')->user();

        $user = User::where([
            'name' => 'newman.net',
        ])->first();

        Auth::guard("insights")->login($user);

        $request->session()->regenerate();

        return redirect()->intended(route('insights.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('insights')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/exit');
    }
}
