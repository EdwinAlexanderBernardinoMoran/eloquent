<?php

use App\Models\Destination;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function() {

    /*
    $flights = Flight::where('active', 1)
                ->where('legs', '>', 2)
                ->orderBy('name', 'desc')
                ->take(3)
                ->get();
    return $flights;

    $flights = Flight::all();

    foreach ($flights as $key => $flight) {
        $flight->number = 'a-' . $flight->number;
        $flight->save();
    }

    Cuando queremos editar una gran cantidad de archivos.
    Flight::chunk(20, function($flights) {
        foreach ($flights as $flight) {
            $flight->number = 'a-' . $flight->number;
            $flight->save();
        }
    });

    Cuando queremos modificar por el mismo metodo que filtramos = solucion 1
     Flight::where('departed', true)->chunkById(20, function($flights) {
        foreach ($flights as $flight) {
            $flight->departed = false;
            $flight->save();
        }
    }, 'id');

    Este metodo cursor genera generadores de php, osea se va almacenando un modelo eloquent a la vez conforme se va iterando
    foreach (Flight::cursor() as $flight) {
        $flight->active = true;
        $flight->save();
    }


    return $flights;

    */


    $destinations = Destination::addSelect([
        'last_flight' => Flight::select('number')->whereColumn('destination_id', 'destinations.id')->orderBy('arrived_at', 'desc')->limit(1)
    ])->get();

    return $destinations;

})->name('flight');
