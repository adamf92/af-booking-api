<?php

use Illuminate\Http\Request;

/**
 * apiRoute
 *
 * Return route with api middleware
 * @return Route
 */
function apiRoute() {
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
apiRoute()->get('/days/{year}/{month}', 'DayController@getAllByMonth');
apiRoute()->get('/days/{room}/{year}/{month}', 'DayController@getForRoomByMonth');
/*
-------> ReservationController routes <-------
*/
// Single reservation actions
apiRoute()->get('/reservations/{reservation}', 'ReservationController@getById');
apiRoute()->post('/reservations', 'ReservationController@create');
apiRoute()->put('/reservations/{reservation}', 'ReservationController@update');
apiRoute()->delete('/reservations/{reservation}', 'ReservationController@delete');
// Group actions
apiRoute()->get('reservations', 'ReservationController@getAll');
/*
-------> ClientController routes <-------
*/
// Single client actions
apiRoute()->get('/clients/{client}', 'ClientController@getById');
apiRoute()->post('/clients', 'ClientController@create');
apiRoute()->put('/clients/{client}', 'ClientController@update');
apiRoute()->delete('/clients/{client}', 'ClientController@delete');
// Group actions
apiRoute()->get('/clients', 'ClientController@getAll');
/*
-------> PaymentController routes <-------
*/
apiRoute()->get('/reservations/{reservation}/payments', 'PaymentsController@getPayments');
apiRoute()->post('/reservations/{reservation}/payments', 'PaymentsController@createPayment');
/*
-------> RoomController routes <-------
*/
apiRoute()->get('/rooms/{room}', 'RoomController@getRoomReservations');