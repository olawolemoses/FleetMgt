<?php

namespace App\Http\Controllers;

use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

use App\Vehicle;
use App\VehicleCategory;
use App\Category;

use App\Transformers\VehicleTransformer;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

  private $fractal;

  public function __construct()
  {
      $this->fractal = new Manager();
  }

  public function showAllVehiclesByCategory($id)
  {
      $vehicles = Vehicle::whereHas('vehicleCategory.category', function ($query) use($id) {
                        $query->where('id', '=', $id)
                        ->orWhere('slug', $id);
                    })->get();



      return response()->json($vehicles);
  }

    public function showAllVehicles()
    {
        $vehicles = Vehicle::with('vehicleCategory.category');

        $vehicles = $vehicles->paginate();

        $paginator = Vehicle::with('vehicleCategory.category')->paginate();

        $vehicles = $paginator->getCollection();

        $resource = new Collection($vehicles, new VehicleTransformer);

        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $this->fractal->createData($resource)->toArray();
    }

    public function showOneDeveloper($id)
    {
        $vehicle = Vehichle::find($id);

        $resource = new Item($vehicle, new VehicleTransformer);

        return $this->fractal->createData($resource)->toArray();
    }

    public function create(Request $request )
    {
      $this->validate($request, [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email|unique:developer_contacts',
          'phoneno' => 'required',
          'skypeid' => 'required|unique:developer_contacts',
          'linkedin' => 'required|unique:developer_contacts',
          'country' => 'required|alpha',
      ]);

        $vehicle = Vehichle::create($request->all());

        $resource = new Item($vehicle, new VehichleTransformer);

        return $this->fractal->createData($resource)->toArray();
    }

    public function addToCategory(Request $request, $id)
    {
      $category = Category::where('id', $id)->orWhere('slug', $id)->firstOrFail();

      if(!$category)
          return $this->errorResponse('Category not found!', 404);

        $this->validate($request, [
            'vehicle_id' => 'required'
        ]);

        if(!Vehichle::find($request->input('vehicle_id')))
            return $this->errorResponse('Developer not found!', 404);

        $vehicle = Vehicle::findOrFail($request->input('vehicle_id'));

        $vehicleCategory = vehicleCategory::where('category_id', $id)->firstOrFail();

        if( is_null( $vehicleCategory ) ) {
            $vehicleCategory = new vehicleCategory;
            $vehicleCategory->category_id = $id;
        }

        $vehicleCategory->vehicle_id = $vehicle->id;
        if( $vehicleCategory->save() )
            return $this->customResponse('Developer added to category successfully!', 200);
        else
            return $this->errorResponse('Failed to update category!', 400);
    }

    public function update( Request $request, $id)
    {
      $this->validate($request, [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required|email|unique:developer_contacts,id,'.$request->get('id'),
          'phoneno' => 'required',
          'skypeid' => 'required|unique:developer_contacts,id,'.$request->get('id'),
          'linkedin' => 'required|unique:developer_contacts,id,'.$request->get('id'),
          'country' => 'required|alpha',
      ]);
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        if($vehicle){
            //return updated data
            $resource = new Item(Vehicle::find($id), new VehichleTransformer);
            return $this->fractal->createData($resource)->toArray();
        }
        //Return error 400 response if updated was not successful
        return $this->errorResponse('Failed to update Developer Contact!', 400);
    }

    public function delete($id)
    {
        if(!Vehichle::find($id))
          return $this->errorResponse('Developer not found!', 404);

        $vehicle = Vehicle::find($id);

        $vehicleCategory = $vehicle->vehicleCategory();

        $vehicleCategory->delete();

        if($vehicle->delete())

          return $this->customResponse('Developer deleted successfully!', 410);

        return $this->errorResponse('Failed to delete developer!', 400);
    }

    public function customResponse($message = 'success', $status = 200)
    {
        return response(['status' =>  $status, 'message' => $message], $status);
    }

    public function errorResponse($message = 'fail', $status = 404)
    {
        return response(['status' =>  $status, 'message' => $message], $status);
    }
}
