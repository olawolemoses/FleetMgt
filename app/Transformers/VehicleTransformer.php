<?php
namespace App\Transformers;
use App\Vehicle;
use League\Fractal;

class VehicleTransformer extends Fractal\TransformerAbstract
{
	public function transform(Vehicle $vehicle)
	{
	    return [
	        'id'      => (int) $vehicle->id,
	        'product_id'   => $vehicle->product_id,
	        'product_name'   => $vehicle->product_name,
	        'brand'   =>    $vehicle->brand,
	        'body_type'   => $vehicle->body_type,
	        'color'    =>  $vehicle->color,
	        'no_of_doors'    =>  $vehicle->no_of_doors,
	        'seating_capacity'    =>  $vehicle->seating_capacity,
	        'speed'    =>  $vehicle->speed,
	        'acceleration_time'    =>  $vehicle->acceleration_time,
	        'weight'    =>  $vehicle->weight,
					'item_condition'    =>  $vehicle->item_condition,
	        'model_date'    =>  $vehicle->model_date,
	        'purchase_date'    =>  $vehicle->purchase_date,
            'links'   => [
                [
                    'uri' => 'vehicles/'.$vehicle->id,
                ]
            ],
	    ];
	}
}
