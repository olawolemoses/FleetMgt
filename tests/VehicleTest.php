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
                  "links"
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
                  'links'
                ]
            ]
        );
    }

    /**
         * api/category/ [POST]
         */
        public function testShouldCreateVehicle(){

            $parameters = [
                  "product_id"=> "101-739-031",
                  "product_name"=> "Land King",
                  "brand"=> "Beijing",
                  "body_type"=> "SUV",
                  "color"=> "White",
                  "no_of_doors"=> 4,
                  "seating_capacity"=> 6,
                  "speed"=> 89.245,
                  "acceleration_time"=> 0.587,
                  "weight"=> 751.41,
                  "model_date"=> "1984-11-19",
                  "purchase_date"=> "2004-04-03"
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
                "product_id"=> "101-739-031",
                "product_name"=> "Land King",
                "brand"=> "Beijing",
                "body_type"=> "SUV",
                "color"=> "White",
                "no_of_doors"=> 4,
                "seating_capacity"=> 6,
                "speed"=> 89.245,
                "acceleration_time"=> 0.587,
                "weight"=> 751.41,
                "model_date"=> "1984-11-19",
                "purchase_date"=> "2004-04-03"
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
