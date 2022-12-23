<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

/** -----------------------------------------------------------------------------------------------------------------
 * Passing URL Arguments to Views
 * ----------------------------------------------------------------------------------------------------------------- */

Route::get('/car/{make}/{model}/{option}', function($make, $model, $option) {
    return view('car', [
        'make' => $make,
        'model' => $model,
        'option' => $option,
        'user_type' => "admin",
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Subdirectories
 * ----------------------------------------------------------------------------------------------------------------- */

Route::get('/cars', function() {
    if (View::exists('cars.index')) {
        return view('cars/index');
    }

    return null;
});

/** -----------------------------------------------------------------------------------------------------------------
 * Blade Components
 * ----------------------------------------------------------------------------------------------------------------- */

Route::get('/cars/my/favorites', function() {
    return view('cars/favorite', [
        'cars' => [
            "2003 Chevy Corvette",
            "2007 Chevy Corvette",
            "1999 Nissan Skyline GT-R",
            "2021 Nissan GT-R",
            "2022 Porsche 911 GT3",
            "1994 Toyota Supra 2JZGTE",
            "1989 Nissan 240SX Hatchback",
            "2019 Subaru WRX STi",
            "1998 Dodge Viper GTS-R",
        ]
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Blade Components Digging Deeper
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/my-favorite-car', function() {
    return view('cars/car', [
        'car' => 'Subaru WRX STi',
    ]);
});

Route::get('/my-favorite-car/with-htmlspecialchars', function() {
    return view('cars/car', [
        'car' => '<script>alert("Subaru WRX STi");</script>',
    ]);
});

Route::get('/my-favorite-car/without-htmlspecialchars', function() {
    return view('cars/car-alert', [
        'car' => '<script>alert("Subaru WRX STi");</script>',
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * If and Switch
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/car-if-directive/{year}', function($year) {
    return view('if-directive/gtr-if', [
        'year' => $year,
    ]);
});

Route::get('/car-elseif-directive/{year}', function($year) {
    return view('if-directive/gtr-elseif', [
        'year' => $year,
    ]);
});

Route::get('/car-switch-directive/{year}', function($year) {
    return view('switch-directive/gtr-switch', [
        'year' => $year,
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Loops
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/loops/for/{value}', function($value) {
    return view('loops/for-loop', [
        'value' => $value,
    ]);
});

Route::get('/loops/foreach', function() {
    return view('loops/foreach-loop', [
        "things_to_buy" => [
            "meat shredder claws",
            "taco sleeping bag",
            "tortilla toaster",
            "the keyboard waffle iron"
        ],
    ]);
});

Route::get('/loops/forelse', function() {
    return view('loops/forelse-loop', [
        "things_to_buy" => [],
    ]);
});


