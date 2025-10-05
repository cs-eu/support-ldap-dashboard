<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class BeamerAccessEvent
{
    use Dispatchable;

    public $name;
    public $email;

    /**
     * Create a new event instance.
     */
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}
