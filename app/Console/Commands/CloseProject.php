<?php

namespace App\Console\Commands;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CloseProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:close-project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Project::query()
            ->where('ends_at', '<', now())
            ->update(['status' => ProjectStatus::Closed]);
        Log::info('Rodou o comando');
    }
}
