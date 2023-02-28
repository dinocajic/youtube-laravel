<?php

namespace App\View\Composers;

use App\Models\Car;
use Illuminate\View\View;

class CarComposer
{
    public function compose(View $view): void
    {
        $view->with('cars', Car::orderby('make')->orderby('model')->get());
    }
}
