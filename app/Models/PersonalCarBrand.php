<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalCarBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug',
    ];

    public function cars()
    {
        return $this->hasMany(PersonalCar::class, 'personal_car_brand_id', 'id');
    }
}
