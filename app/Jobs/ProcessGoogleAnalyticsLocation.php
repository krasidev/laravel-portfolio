<?php

namespace App\Jobs;

use App\Models\GoogleAnalyticsLocation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Analytics\Period;

class ProcessGoogleAnalyticsLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $period;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Period $period)
    {
        $this->period = $period;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $performQuery = \Analytics::performQuery($this->period, 'ga:users,ga:pageviews', [
            'dimensions' => 'ga:date,ga:continent,ga:country,ga:city'
        ]);

        collect($performQuery['rows'] ?? [])->map(function ($row) {
            GoogleAnalyticsLocation::updateOrCreate([
                'date' => Carbon::createFromFormat('Ymd', $row[0])->format('Y-m-d'),
                'continent' => $row[1],
                'country' => $row[2],
                'city' => $row[3]
            ], [
                'visitors' => (int) $row[4],
                'pageviews' => (int) $row[5]
            ]);
        });
    }
}
