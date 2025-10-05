<?php

namespace App\Console\Commands;

use App\Models\BeamerAccess;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PruneBeamerAccesses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prune-beamer-accesses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune beamer accesses which are older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timeThreshold = Carbon::now()->subDays(30);
        BeamerAccess::where('accessed_at', '<', $timeThreshold)->delete();
    }
}
