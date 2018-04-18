<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * getAllByMonth
     *
     * Get all reserved days for all rooms in selected month
     * @param integer $year
     * @param integer $month
     * @return Response
     */
    public function getAllByMonth(int $year, int $month): Response {
        // TODO
        $data = [
            'room_id' => [
                'day_id' => [] //day
            ]
        ];
        
        return response()->json($data, 200);
    }

    /**
     * getForRoomByMonth
     *
     * Get all reserved days for selected room in selected month
     * @param integer $year
     * @param integer $month
     * @return Response
     */
    public function getForRoomByMonth(int $room, int $year, int $month): Response {
        // TODO
        $data = [
            'day_id' => [] //day
        ];
        
        return response()->json($data, 200);
    }
}
