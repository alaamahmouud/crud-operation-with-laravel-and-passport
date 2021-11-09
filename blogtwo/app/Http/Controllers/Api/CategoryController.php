<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    public function index()
    {
       $categories = category::all();
       return response()->json([
       "success" => true,
       "data" => CategoryResource::collection($categories)
     ]);
}
    public function show($test)
    {
        $category = category::find($test);

        return new CategoryResource($category) ;
    }

    public function store(request $req)
    {

        $category = category::create([
            'name' =>$req['name'],
        ]);

        return new CategoryResource($category);

    }

    public function update(request $req , $id)
    {
        $category = category::find($id);
        
        $category->update([
            'name' => $req->name,
        ]);

        return new CategoryResource($category);
    }

    public function destroy($id)  
    {  
        category::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => "category deleted successfully!"
        ]);
    } 
}
