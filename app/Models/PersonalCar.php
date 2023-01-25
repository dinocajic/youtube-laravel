<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    protected function currentValue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => "$" . number_format($value / 100, 2, '.', ','),
        );
    }

    protected function purchaseAmount(): Attribute
    {
        return Attribute::make(
            get: fn($value) => "$" . number_format($value / 100, 2, '.', ','),
        );
    }

    protected function salesAmount(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == 0 ? "N/A" : "$" . number_format($value / 100, 2, '.', ',')),
        );
    }

    protected function isManual(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == 1 ? "Manual" : "Automatic"),
        );
    }

    protected function dateSold(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($value == null ? "N/A" : $value),
        );
    }
}
