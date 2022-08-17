<?php

namespace App\Console\Commands;

use App\Models\History;
use App\Models\Indicator;
use App\Models\Tracing;
use App\Models\TracingHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;

class TracingCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracing:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to iterate through tracings created during the defined period';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return array
     */
    public function handle(): array
    {
        $frequency = Indicator::firstWhere('type', Indicator::$FREQ);
        $startDate = Indicator::firstWhere('type', Indicator::$MIN_DATE);
        $endDate = Indicator::firstWhere('type', Indicator::$MAX_DATE);
        $userTracings = DB::table('tracings')
            ->whereBetween('created_at', [
                    $startDate->date,
                    $endDate->date
                ]
            )
            ->get()
            ->mapToGroups(function ($item, $key) {
                return [$item->user_id=>$item->id];
            });

        $history = array();
        foreach ($userTracings as $key => $value) {
            $h = History::create([
                'user_id'=>$key,
                'period_start'=>$startDate->date,
                'period_end'=>$endDate->date
            ]);
            $h->tracings()->syncWithoutDetaching($value);
            $history[] = $h;
        }
        $d = Carbon::now();
        $startDate->date = $d;
        $startDate->save();
        $endDate->date = Carbon::now()->addUnit('minute', $frequency->value);
        $endDate->save();

        return [
            $history,
            'Nuevo periodo: '.$startDate->date.'-'.$endDate->date
        ];
    }
}
