<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'year', 'is_manual', 'exterior_color', 'purchase_amount', 'current_value', 'sales_amount', 'date_purchased', 'date_sold'
    ];

    public function brand()
    {
        return $this->belongsTo(PersonalCarBrand::class, 'personal_car_brand_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(PersonalCarModel::class, 'personal_car_model_id', 'id');
    }
}
