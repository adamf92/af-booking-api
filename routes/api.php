<?php

use Illuminate\Http\Request;

/**
 * api
 *
 * Return route with api middleware
 * @return Route
 */
function api() {
    return Route::middleware("auth:api");
}

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


/*
-------> DayController routes <-------
----> The Calendar actions
*/
api()->get('/calendar/{year}/{month}', 'DayController@getAllByMonth');
api()->get('/calendar/rooms/{room}/{year}/{month}', 'DayController@getForRoomByMonth');
/*
-------> ReservationController routes <-------
*/
// Single reservation actions
api()->get('/reservations/{reservation}', 'ReservationController@getById');
api()->post('/reservations', 'ReservationController@create');
api()->put('/reservations/{reservation}', 'ReservationController@update');
api()->delete('/reservations/{reservation}', 'ReservationController@delete');
// Group actions
api()->get('reservations', 'ReservationController@getAll');
/*
-------> ClientController routes <-------
*/
// Single client actions
api()->get('/clients/{client}', 'ClientController@getById');
api()->post('/clients', 'ClientController@create');
api()->put('/clients/{client}', 'ClientController@update');
api()->delete('/clients/{client}', 'ClientController@delete');
// Group actions
api()->get('/clients', 'ClientController@getAll');
/*
-------> PaymentController routes <-------
*/
api()->get('/reservations/{reservation}/payments', 'PaymentsController@getPayments');
api()->post('/reservations/{reservation}/payments', 'PaymentsController@createPayment');
/*
-------> RoomController routes <-------
*/
api()->get('/rooms/{room}', 'RoomController@getRoomReservations');