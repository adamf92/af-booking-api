<?php

namespace App;


class Calendar
{

    /**
     * Month Calendar
     *
     * Generate calendar array for every room in hotel
     * JSON Schema:
     * "0":
     *   { year: int, $month: int},
     * "1..(28-31)": {
     *      "roomNumber(int)": {
     *          "number": int,
     *          "reservation": {
     *              "day": int,
     *              "status": int (0-free, 1-preReserved, 2-confirmed, 3-paid, 4-twoReservations(end one & start another),
     *              "start": boolean,
     *              "end": boolean
     *            }
     *        }
     *    }
     * @param int $year
     * @param int $month
     * @return mixed
     */
    public static function monthCalendar(int $year,int $month) {
        $numDays = self::_daysNumberCalculator($year, $month);
        $rooms = Room::all();
        $calendar[0] = [
            'year' => $year,
            'month' => $month
        ];
        for ($i = 1; $i <= $numDays; $i++) {
            foreach ($rooms as $room) {
                $dayRoom = self::_checkDaysForRoom($room, $year, $month, $i);
                $calendar[$i]["$room->number"] = [
                    'number' => $room->number,
                    'reservation' => $dayRoom
                ];
            }
        }

        return $calendar;
    }

    /**
     * Room Month Calendar
     *
     *  * Generate calendar array for selected room in hotel
     * JSON Schema:
     * "0":
     *   { year: int, $month: int, $room: int},
     * "1..(28-31)": {
     *              "day": int,
     *              "status": int (0-free, 1-preReserved, 2-confirmed, 3-paid, 4-twoReservations(end one & start another),
     *              "start": boolean,
     *              "end": boolean
     *  }
     * @param int $roomNumber
     * @param int $year
     * @param int $month
     * @return mixed
     */
    public static function roomMonthCalendar(int $roomNumber, int $year, int $month) {
        $numDays = self::_daysNumberCalculator($year, $month);
        $room = Room::select()->room($roomNumber)->get()->first();
        $calendar[0] = [
            'year' => $year,
            'month' => $month,
            'room' => $room
        ];

        for ($i = 1; $i <= $numDays; $i++) {
            $dayRoom = self::_checkDaysForRoom($room, $year, $month, $i);
            $calendar[$i] = $dayRoom;
        }

        return $calendar;

    }


    /**
     * Check Days For Room
     * (private)
     *
     * Check if selected day is reserved for selected room
     * @param $room
     * @param $year
     * @param $month
     * @param $dayNum
     * @return array
     */
    private static function _checkDaysForRoom($room, $year, $month, $dayNum) {
        $day = Day::select()->room($room->id)->year($year)->month($month)->day($dayNum)->get();
        if ($day->first()) {
            if ($day->count() > 1) {
                return [
                    'day' => $dayNum,
                    'status' => 4,
                    'start' => true,
                    'end' => true
                ];
            } else {
                $day = $day->first();
                return [
                    'day' => $dayNum,
                    'status' => $day->status,
                    'start' => $day->start == 1 ? true : false,
                    'end' => $day->end == 1 ? true : false
                ];
            }
        } else {
            return [
                'day' => $dayNum,
                'status' => 0,
                'start' => false,
                'end' => false
            ];
        }
    }

    /**
     * Days Number Calculator
     *
     * Calculate number of days in selected month and year
     * @param int $year
     * @param int $month
     * @return int
     */
    private static function _daysNumberCalculator(int $year, int $month): int {
        switch ($month) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                return 31;
            case 4:
            case 6:
            case 9:
            case 11:
                return 30;
            case 2:
                if ($year % 4 == 0) {
                    return 29;
                } else {
                    return 28;
                }
        }
    }

}
