<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class VehicleTest extends TestCase
{
  use DatabaseTransactions;
    /**
     * api/vehicles [GET]
     */
    public function testShouldReturnAllVehicles(){

        $this->get("api/vehicles", []);
        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                  "id"
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
                  "purchase_date",
                  "item_condition",
                  'links'
                  ]
                ]
            ],
            'meta' => [
                'pagination' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);

    }

    /**
     * api/developers/id [GET]
     */

    public function testShouldReturnVehicle(){
        $this->get("/api/vehicles/2", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                  "id"
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
                  "purchase_date",
                  "item_condition",
                  'links'
                ]
            ]
        );
    }

    /**
         * api/vehicles/ [POST]
         */
        public function testShouldCreateVehicle(){

            $parameters = [
                "product_id": "090-969-080",
                "product_name": "Pors",
                "brand": "Peugeot",
                "body_type": "Big",
                "color": "White",
                "no_of_doors": 4,
                "seating_capacity": 6,
                "speed": 63.199,
                "acceleration_time": 1.592,
                "weight": 174.91,
                "model_date": "1994-11-12",
                "item_condition": "Excellent",
                "purchase_date": "1994-06-26"
            ];

            $this->post("api/vehicles", $parameters, []);
            $this->seeStatusCode(200);
            $this->seeJsonStructure(
                ['data' =>
                      [
                        "id"
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
                        "purchase_date",
                        "item_condition",
                        'links'
                      ]
                ]
            );

        }

        /**
         * /api/vehicles/21 [PUT]
         */
        public function testShouldUpdateVehicle(){
            $parameters = [
              "product_id": "090-969-080",
                "product_name": "Pors",
                "brand": "Peugeot",
                "body_type": "Big",
                "color": "White",
                "no_of_doors": 4,
                "seating_capacity": 6,
                "speed": 63.199,
                "acceleration_time": 1.592,
                "weight": 174.91,
                "model_date": "1994-11-12",
                "item_condition": "Excellent",
                "purchase_date": "1994-06-26"
            ];
            $this->put("api/vehicles/5", $parameters, []);
            $this->seeStatusCode(200);
            $this->seeJsonStructure(
                ['data' =>
                    [
                      "id"
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
                      "purchase_date",
                      "item_condition",
                      'links'
                    ]
                ]
            );
        }
        /**
         * /products/id [DELETE]
         */
        public function testShouldDeleteVehicle() {

            $this->delete("api/vehicles/20", [], []);
            $this->seeStatusCode(410);
            $this->seeJsonStructure([
                    'status',
                    'message'
            ]);
        }

        public function testShouldAddVehicleToCategory() {
            $parameters = [
                "vehicle_id"=> "2"
            ];
            $this->post("api/category/2", $parameters, []);
            $this->seeStatusCode(200);
            $this->seeJsonStructure([
                    'status',
                    'message'
            ]);
        }


}
