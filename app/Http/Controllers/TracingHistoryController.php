<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Tracing;
use App\Models\TracingHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TracingHistoryController extends ResourceController
{
    //
    protected function getModel(): string
    {
        return 'App\Models\TracingHistory';
    }

    public function store(Request $request): JsonResponse
    {
        return self::notAllowed();
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        return self::notAllowed();
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return self::notAllowed();
    }

    public function forceRun(Request $request): JsonResponse
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
//        return self::baseResponse($userTracings);

        $history = array();
        foreach ($userTracings as $key => $value) {
            $th = TracingHistory::create([
                'user_id'=>$key,
                'tracing_ids'=>$value,
                'period_start'=>$startDate->date,
                'period_end'=>$endDate->date
            ]);
            $history[] = $th;
        }
        $d = Carbon::now();
        $startDate->date = $d;
        $startDate->save();
        $endDate->date = Carbon::now()->addUnit('minute', $frequency->value);
        $endDate->save();

        return self::baseResponse(
            $history,
            'Nuevo periodo: '.$startDate->date.'-'.$endDate->date
        );
    }
}
