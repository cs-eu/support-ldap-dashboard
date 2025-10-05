<?php

namespace App\Http\Middleware;

use App\Models\Auth\User;
use Closure;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request)
    {
        $user = $request->user();
        if ($user instanceof GenericUser) {
            $user = ["name" => $user->name];
        }

        $user_insights = $request->user("insights");

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? $user : $user_insights,
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'localization' => [
                'current_locale' => app()->getLocale(),
                'locales' => config('app.available_locales')
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'info' => $request->session()->get('info'),
                    'warning' => $request->session()->get('warning'),
                    'error' => $request->session()->get('error'),
                ];
            }
        ]);
    }

    public function handle(Request $request, Closure $next)
    {
        $response = parent::handle($request, $next);

        // Replace status code and redirect in case we are redirecting outside our application
        if ($response->getStatusCode() == 302) {
            $url = $response->headers->get('Location');
            if ($request->inertia() && !Str::startsWith($url, config('app.url'))) {
                $response->setStatusCode(409);
                $response->header('X-Inertia-Location', $url);
            }
        }
        return $response;
    }
}
