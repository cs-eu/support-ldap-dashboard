<?php

namespace App\Http\Controllers\Beamer;

use App\Events\BeamerAccessEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeamerUnlockRequest;
use App\Models\BeamerAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Inertia;
use PhpMqtt\Client\Facades\MQTT;

class BeamerAccessController extends Controller
{
    public function create(BeamerUnlockRequest $request)
    {
        // push MQTT
        $executed = RateLimiter::attempt(
            'send-message',
            $maxAttempts = 1,
            function () use ($request) {
                if (App::environment('production')) {
                    $mqtt = MQTT::connection();
                    $mqtt->publish(env('MQTT_TOPIC'), 'unlock', 1);
                }
                // Fire BeamerAccessEvent
                BeamerAccessEvent::dispatch(
                    $request->user()->name,
                    $request->user()->email
                );
            },
            $decaySeconds = 10,
        );

        if (! $executed) {
            return redirect()->back()->with('error', trans("beamer.rate_limit"));
        }


        return redirect()->back()
            ->with('success', trans('beamer.unlocked'));
    }

    public function retrieve(Request $request)
    {
        return Inertia::render('Beamer/UnlockBeamer', []);
    }

    public function retrieve_all(Request $request)
    {
        return Inertia::render('Beamer/BeamerAccesses', ['beamerAccess' => BeamerAccess::all()]);
    }


    public function delete(Request $request, BeamerAccess $beamerAccess)
    {
        // TODO: delete beamer access
    }
}
