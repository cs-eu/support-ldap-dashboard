<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\GenericUser;

class AdministrationAuthenticatedSessionController extends Controller
{
    /**
     * Redirect function to start authentication via Socialite
     *
     * @return RedirectResponse
     */
    public function redirect(Request $request)
    {
        if ($request->hasCookie("token")) {
            $token = $request->cookie("token");
            $user_details = Socialite::driver('newman_administration')->userFromToken($token);
            if ($user_details->getId() != null) {
                $this->login($request, $user_details);
                return redirect()->back();
            }
        }

        return Socialite::driver('newman_administration')->scopes(["read_user"])->redirect();
    }

    /**
     * Callback function invoked via Socialite
     *
     * @return RedirectResponse
     */
    public function callback(Request $request)
    {
        $user_details = Socialite::driver('newman_administration')->user();
        $this->login($request, $user_details);

        $cookie = cookie()->forever("token", $user_details->token);
        return redirect()->route('welcome')->cookie($cookie);
    }

    private function login(Request $request, $user_details)
    {
        $details = array_merge($user_details->getRaw(), ["remember_token" => null]);
        $user = new GenericUser($details);

        Auth::login($user);
        $request->session()->put('user', $user);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->forget('user');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/exit');
    }

    /**
     * Show an exit page, to not re-login immediately
     *
     * @return Response
     */
    public function exit(Request $request)
    {
        return Inertia::render('Auth/Exit');
    }

}
