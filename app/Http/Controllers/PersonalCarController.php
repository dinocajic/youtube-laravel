<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\PersonalCar;
use App\Models\PersonalCarBrand;
use App\Models\PersonalCarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = PersonalCar::with(['brand', 'model'])->orderBy('year', 'desc')->get();

//        return view('personalcars/index', [
//            'title' => 'Personal Cars',
//            'cars' => $cars,
//        ]);

        return view('personalcars/index')
            ->with('title', 'Personal Cars')
            ->with('cars', $cars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personalcars/create', [
            'title' => 'Personal Cars'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'make' => 'required|max:255',
            'model' => 'required|max:255',
            'is_manual' => 'required|boolean',
            'exterior_color' => 'required|max:255',
            'purchase_amount' => 'numeric',
            'current_value' => 'numeric',
            'sales_amount' => 'numeric|nullable',
            'date_purchased' => 'required|date',
            'date_sold' => 'date|nullable',
            'file' => 'image|mimes:jpg,jpeg,png,gif|max:2048|nullable',
        ]);

        $brand = PersonalCarBrand::firstOrCreate([
            'name' => $request->make,
        ], [
            'slug' => str_replace(" ", "-", strtolower($request->make))
        ]);

        $model = PersonalCarModel::firstOrCreate([
            'name' => $request->model,
        ], [
            'slug' => str_replace(" ", "-", strtolower($request->model))
        ]);

        $car = new PersonalCar;
        $car->year            = $request->year;
        $car->brand()->associate($brand);
        $car->model()->associate($model);
        $car->is_manual       = $request->is_manual;
        $car->exterior_color  = $request->exterior_color;
        $car->purchase_amount = $request->purchase_amount;
        $car->current_value   = $request->current_value;
        $car->sales_amount    = $request->sales_amount == 0 ? 0 : $request->sales_amount;
        $car->date_purchased  = $request->date_purchased;
        $car->date_sold       = $request->date_sold;

        $car->save();

        if ( $request->file('file') !== null ) {
            $image_path = $request->file('file')->store('images', 'public');

            $image = Image::create([
                'url' => $image_path,
                'alt' => $request->year . " " . $brand->name . " " . $model->name,
            ]);

            $car->images()->attach($image);
        }

        return redirect()->to('/personalcars/')->with('status', 'Your car has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $car = PersonalCar::with(['brand', 'model', 'images'])->find($id);

        return view('personalcars/show', [
            'title' => $car->year . " " . $car->brand->name . " " . $car->model->name,
            'car' => $car,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $car = PersonalCar::with(['brand', 'model', 'images'])->find($id);

        return view('personalcars/edit', [
            'title' => "Edit " . $car->year . " " . $car->brand->name . " " . $car->model->name,
            'car' => $car,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'make' => 'required|max:255',
            'model' => 'required|max:255',
            'is_manual' => 'required|boolean',
            'exterior_color' => 'required|max:255',
            'purchase_amount' => 'numeric',
            'current_value' => 'numeric',
            'sales_amount' => 'numeric|nullable',
            'date_purchased' => 'required|date',
            'date_sold' => 'date|nullable',
            'file' => 'image|mimes:jpg,jpeg,png,gif|max:2048|nullable',
        ]);

        $car = PersonalCar::find($id);

        $brand = PersonalCarBrand::firstOrCreate([
            'name' => $request->make,
        ], [
            'slug' => str_replace(" ", "-", strtolower($request->make))
        ]);

        $model = PersonalCarModel::firstOrCreate([
            'name' => $request->model,
        ], [
            'slug' => str_replace(" ", "-", strtolower($request->model))
        ]);

        $car->year            = $request->year;
        $car->brand()->associate($brand);
        $car->model()->associate($model);
        $car->is_manual       = $request->is_manual;
        $car->exterior_color  = $request->exterior_color;
        $car->purchase_amount = $request->purchase_amount;
        $car->current_value   = $request->current_value;
        $car->sales_amount    = $request->sales_amount == 0 ? 0 : $request->sales_amount;
        $car->date_purchased  = $request->date_purchased;
        $car->date_sold       = $request->date_sold;

        $car->save();

        if ( $request->file('file') !== null ) {
            $image_path = $request->file('file')->store('images', 'public');

            $image = Image::create([
                'url' => $image_path,
                'alt' => $request->year . " " . $brand->name . " " . $model->name,
            ]);

            $car->images()->attach($image);
        }

        return redirect()->to('/personalcars/' . $id . '/edit')->with('status', 'Your car has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $car = PersonalCar::find($id);

        foreach($car->images as $image) {
            Storage::disk('public')->delete( $image->url );
        }

        $car->images()->delete();
        $car->images()->detach();
        $car->destroy($id);

        return redirect()->to('/personalcars/')->with('status', 'Your car has been deleted.');
    }
}
