<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Day
 *
 * Model class for days in calendar
 * @package App
 */
class Day extends Model
{

    /*
     * Relations
     */

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }

    /*
     * Query Builder helpers
     */

    public function scopeDay($query, $day) {
        $query->where('day', $day);
    }

    public function scopeMonth($query, $month) {
        $query->where('month', $month);
    }

    public function scopeYear($query, $year) {
        $query->where('year', $year);
    }

    public function scopeRoom($query, $room) {
        $query->where('room_id', $room);
    }
}
