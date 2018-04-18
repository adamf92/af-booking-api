<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\JsonResponse;

class DayController extends Controller
{
    /**
     * getAllByMonth
     *
     * Get all reserved days for all rooms in selected month
     * @param integer $year
     * @param integer $month
     * @return JsonResponse
     */
    public function getAllByMonth(int $year, int $month): JsonResponse {

        $data = Calendar::monthCalendar($year, $month);
        
        return response()->json($data, 200);
    }

    /**
     * getForRoomByMonth
     *
     * Get all reserved days for selected room in selected month
     * @param integer $year
     * @param integer $month
     * @return JsonResponse
     */
    public function getForRoomByMonth(int $room, int $year, int $month): JsonResponse {

        $data = Calendar::roomMonthCalendar($room, $year, $month);
        
        return response()->json($data, 200);
    }
}
