<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    /*
     * Relations
     */

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function days() {
        return $this->hasMany(Day::class);
    }


    /*
     * Query Builder Helpers
     */

    public function scopeRoom($query, $room) {
        $query->where('number', $room);
    }
}
