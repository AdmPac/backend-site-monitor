<?php

namespace App\Jobs;

use App\Models\Site;
use App\Service\LogService;
use App\Service\SiteService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PingProccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Site $site, 
    ){}

    /**
     * Execute the job.
     */
    public function handle(SiteService $siteService, LogService $logService): void
    {
        $mainData = $siteService->getData($this->site);
        $logService->log($this->site, $mainData);
    }
}
