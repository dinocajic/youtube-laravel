<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** -----------------------------------------------------------------------------------------------------------------
 * Basic routes and views
 * ----------------------------------------------------------------------------------------------------------------- */

// Returning an index view by going to http://0.0.0.0
Route::get('/', function () {
    return view('index');
});

// Returning a view directly from a route by going to http://0.0.0.0/welcome
Route::get('/welcome', function () {
    return view('welcome');
});

/** -----------------------------------------------------------------------------------------------------------------
 * URL Parameters
 * ----------------------------------------------------------------------------------------------------------------- */

// Single Argument: http://0.0.0.0/about/Dino
Route::get('/about/{name}', function ($name) {
    return $name;
});

// Same as above
//Route::get('/about/{name}', function ($n) {
//    return $n;
//});

// Multiple URL parameters: http://0.0.0.0/about/Dino/19
Route::get('/about/{name}/{age}', function ($name, $age) {
    if ($age > 100) {
        return "You're pretty old" . $name;
    }

    return $name . ", you're only " . $age . " years old";
});

// Doesn't work as intended since function parameters are bound in order
//Route::get('/about/{name}/{age}', function ($age, $name) {
//    if ($age > 100) {
//        return "You're pretty old" . $name;
//    }
//
//    return $name . ", you're only " . $age . " years old";
//});

// Multiple parameters mixed with other url strings: http://0.0.0.0/about/name/Dino/age/112
Route::get('/about/name/{name}/age/{age}', function ($age, $name) {
    if ($age > 100) {
        return "You're pretty old" . $name;
    }

    return $name . ", you're only " . $age . " years old";
});

// Optional Parameters
Route::get('/users/{name?}', function ($name = null) {
    if ( $name === null ) {
        return "See all of our users below...if we had access to the DB";
    }

    return "This is our user: " . $name;
});

// Regular Expression Constraints
Route::get('/countries/{country}', function ($country) {
    return "The country you selected is: " . $country;
})->where('country', '[A-Za-z]+');

// Multiple Regular Expression Constraints
Route::get('/countries/{country}/{state}', function ($country, $state) {
    return "The country you selected is " . $country . " and you live in the state: " . $state;
})->where([
    'country' => '[A-Za-z]+',
    'state' => '[A-Za-z]{2}+'
]);

// Same as above, just with multiple where methods
//Route::get('/countries/{country}/{state}', function ($country, $state) {
//    return "The country you selected is " . $country . " and you live in the state: " . $state;
//})->where('country', '[A-Za-z]+')
//    ->where('state', '[A-Za-z]{2}+');

// Common regular expression methods
Route::get('/cars/{car}', function ($car) {
    return "Your car is: " . $car;
})->whereAlpha('car');

// Chaining regular expression methods
Route::get('/cars/{car}/{cylinders}', function ($car, $cylinders) {
    return "The car you selected is a " . $car . " with " . $cylinders . " cylinders." ;
})->whereAlpha('car')
    ->whereNumber('cylinders');

// Passing an array of values
Route::get('/cars/{make}/{model}/{cylinders}', function ($make, $model, $cylinders) {
    return "The car you selected is a " . $make . " " . $model . " with " . $cylinders . " cylinders." ;
})->whereAlphaNumeric(['car', 'model'])
    ->whereNumber('cylinders');
