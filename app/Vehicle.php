<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "product_id",
        "product_name",
        "brand",
        "body_type",
        "color",
        "no_of_doors",
        "seating_capacity",
        "speed",
        "acceleration_time",
        "weight",
        "model_date",
        "item_condition",
        "purchase_date"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function vehicleCategory() {
        return $this->hasMany('App\VehicleCategory', 'vehicle_id');
    }

}
