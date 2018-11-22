<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'vehicle_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function vehicle() {
        return $this->belongsTo('App\Vehicle', 'vehicle_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
