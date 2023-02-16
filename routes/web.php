<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\TestController;
use App\Http\Controllers\SacTestController;
use App\Http\Controllers\PersonalCarController;

use App\Http\Controllers\DependencyInjectionTestController;
use Illuminate\Http\Request;
use App\Services\CapitalizeStringService;
use App\Models\User;
use App\Http\Controllers\AnotherDependencyInjectionController;
use App\Http\Controllers\MiddlewareTestController;
use App\Http\Controllers\CameraController;

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

Route::get('/loops/while/{start}/{finish}', function($start, $finish) {
    return view('loops/while-loop', [
        'start' => $start,
        'finish' => $finish,
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Loop Variable
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/loops/foreach-loop-variable', function() {
    return view('loops/foreach-loop-variable', [
        "cars_to_buy" => [
            "1999 Nissan Skyline GT-R",
            "1989 Nissan 240sx",
            "2022 Porsche 911 GT3",
            "1994 Toyota Supra 2JZGTE"
        ],
    ]);
});

Route::get('/loops/foreach-loop-variable-nested', function() {
    return view('loops/foreach-loop-variable-nested', [
        "cars" => [
            "1999 Nissan Skyline GT-R" => [
                "specs" => [1000, "Manual"]
            ],
            "1989 Nissan 240sx" => [
                "specs" => [500, "Manual"]
            ],
            "2022 Porsche 911 GT3" => [
                "specs" => [650, "Manual"]
            ],
            "1994 Toyota Supra 2JZGTE" => [
                "specs" => [1000, "Manual"]
            ],
        ],
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Including Subviews
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/cameras/{camera}', function($camera) {
    return view('cameras/camera', [
        'make' => $camera
    ]);
});

Route::get('/best-camera/{camera}', function($camera) {
    return view('cameras/best-camera', [
        'title' => "Best Camera",
        'make' => $camera
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Raw PHP in Blade Files
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/computers/apple/macbook-pro', function() {
    return view('computers/show', [
        'page_title' => 'Raw PHP',
        'product_sku' => 'B0B3C5HNXJ',
        'product_brand' => 'Apple',
        'product_model' => 'MacBook Pro Laptop with M2 Chip',
        'product_price' => 1299,
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Blade Layouts Using Template Inheritance
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/template-inheritance', function() {
    return view('template-inheritance/home', [
        'title' => "Template Inheritance",
    ]);
});

Route::get('/template-inheritance/contact', function() {
    return view('template-inheritance/contact', [
        'title' => "Contact Page",
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Components Intro
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/components/breakdown-test', function() {
    return view('component-test/breakdown-test', [
        'title' => "Header Test",
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Components Breakdown
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/components-breakdown', function() {
    return view('component-breakdown/app', [
        'title' => 'Component Breakdown',
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Component Layout Prep-Work
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/component-layout-prep', function() {
    return view('layouts-test/index', [
        'title' => 'Component Layout',
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Component Layout
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/component-layout', function() {
    return view('home/index', [
        'title' => 'Component Layout',
    ]);
});

Route::get('/component-layout/contact', function() {
    return view('contact/index', [
        'title' => 'Component Layout - Contact',
    ]);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Redirect
 * ----------------------------------------------------------------------------------------------------------------- */
Route::redirect('/here', '/contact');

/** -----------------------------------------------------------------------------------------------------------------
 * Named Routes
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/home-named', function() {
    return view('home-named/index', [
        'title' => 'Named Routes',
    ]);
});

Route::get('/get-started', function() {
    return "Get Started";
})->name('getting-started');

Route::get('/learn-more/{id}/department/{department}', function($id, $department) {
    return "Learn More: " . $id . " for " . $department;
})->name('learn-more');

/** -----------------------------------------------------------------------------------------------------------------
 * Route Groups
 * ----------------------------------------------------------------------------------------------------------------- */
Route::prefix('admin/{name}')->name('admin.')->group(function($name) {
    Route::get('/contact', function($name) {
        return "Admin - Contact " . $name;
    })->name('contact');

    Route::get('/dashboard', function() {
        return "Admin - Dashboard";
    })->name('dashboard');

    Route::get('/sales', function() {
        return "Admin - Sales";
    })->name('sales');

    Route::get('/marketing', function() {
        return "Admin - Marketing";
    })->name('marketing');
});

/** -----------------------------------------------------------------------------------------------------------------
 * Controllers Intro
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/test-controller/index', [TestController::class, 'index']);
Route::get('/test-controller/show', [TestController::class, 'show']);

/** -----------------------------------------------------------------------------------------------------------------
 * Arguments to Controllers
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/test-controller/edit/{id}', [TestController::class, 'edit']);
Route::get('/test-controller/delete/{id}/name/{name}', [TestController::class, 'delete']);

/** -----------------------------------------------------------------------------------------------------------------
 * Single Action Controller
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/test-single-action-controller/{name}', SacTestController::class);

/** -----------------------------------------------------------------------------------------------------------------
 * Model
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/test-model/store', [TestController::class, 'store']);
Route::get('/test-model/', [TestController::class, 'index']);
Route::get('/test-model/show/{id}', [TestController::class, 'show']);
Route::get('/test-model/update/{id}', [TestController::class, 'update']);
Route::get('/test-model/delete/{id}', [TestController::class, 'destroy']);

/** -----------------------------------------------------------------------------------------------------------------
 * Personal Cars Project
 * ----------------------------------------------------------------------------------------------------------------- */
Route::prefix('/personalcars')->group(function() {
    Route::get('/',          [PersonalCarController::class, 'index']);
    Route::get('/create',    [PersonalCarController::class, 'create']);
    Route::post('/',         [PersonalCarController::class, 'store']);
    Route::get('/{id}',      [PersonalCarController::class, 'show']);
    Route::get('/{id}/edit', [PersonalCarController::class, 'edit']);
    Route::put('/{id}',      [PersonalCarController::class, 'update']);
    Route::delete('/{id}',   [PersonalCarController::class, 'destroy']);
});

/** -----------------------------------------------------------------------------------------------------------------
 * Dependency Injection
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/dependency-injection', [DependencyInjectionTestController::class, 'index']);
Route::get('/dependency-injection/test', [DependencyInjectionTestController::class, 'test']);

/** -----------------------------------------------------------------------------------------------------------------
 * Dependency Injection
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/dependency-route-example', function (Request $request) {
    return $request->input('name');
});

Route::get('/dependency-route-example/{id}',
    function (Request $request, CapitalizeStringService $capitalizeStringService, $id)
    {
        return $id . ": " . $capitalizeStringService->capitalize( $request->input('name') );
    }
);

/** -----------------------------------------------------------------------------------------------------------------
 * Model Binding - Implicit Binding
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/implicit-binding/{user}', function (User $user) {
    return $user;
});

Route::get('/implicit-binding/by-name/{user:name}', function (User $user) {
    return $user;
});

/** -----------------------------------------------------------------------------------------------------------------
 * Model Binding - Explicit Binding
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/explicit-binding/{verifiedUser}', function (User $user) {
    return $user;
});

/** -----------------------------------------------------------------------------------------------------------------
 * Rate Limiting
 * ----------------------------------------------------------------------------------------------------------------- */
Route::middleware(['throttle:web'])->group(function () {
    Route::get('/throttle-test-1', function() {
        return "Throttle Test 1";
    });

    Route::get('/throttle-test-2', function() {
        return "Throttle Test 2";
    });
});

/** -----------------------------------------------------------------------------------------------------------------
 * Controllers - Dependency Injection through constructor
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/controller-dependency-injection', [AnotherDependencyInjectionController::class, 'index']);

/** -----------------------------------------------------------------------------------------------------------------
 * Middleware Controller
 * ----------------------------------------------------------------------------------------------------------------- */
Route::get('/controller-middleware-test', [MiddlewareTestController::class, 'index']);

//Route::get('/controller-middleware-test', [MiddlewareTestController::class, 'edit']);
//
//Route::middleware(['auth'])->group(function () {
//    Route::get('/controller-middleware-test', [MiddlewareTestController::class, 'store']);
//    Route::get('/controller-middleware-test', [MiddlewareTestController::class, 'edit']);
//    Route::get('/controller-middleware-test', [MiddlewareTestController::class, 'edit']);
//});

/** -----------------------------------------------------------------------------------------------------------------
 * Groups
 * ----------------------------------------------------------------------------------------------------------------- */
Route::middleware(['throttle:web', 'auth'])->group(function () {
    Route::get('/throttle-test-3', function() {
        return "Throttle Test 3";
    });

    Route::get('/throttle-test-4', function() {
        return "Throttle Test 4";
    });
});

//Route::controller(PersonalCarController::class)->group(function () {
//    Route::get('/',          'index');
//    Route::get('/create',    'create');
//    Route::post('/',         'store');
//    Route::get('/{id}',      'show');
//    Route::get('/{id}/edit', 'edit');
//    Route::put('/{id}',      'update');
//    Route::delete('/{id}',   'destroy');
//});

Route::resource('cameras', CameraController::class);

