<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'result' => 'true',
            'message' => 'Done!',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        return response()->json([
            'result' => 'true',
            'message' => 'Created!',
            'category' => Category::create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'result' => 'true',
            'message' => 'Done!',
            'category' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->update($request->all());

        return response()->json([
            'result' => 'true',
            'message' => 'Updated!',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json([
            'result' => 'true',
            'message' => 'Deleted!',
            'categories' => Category::destroy($id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($name)
    {
        return response()->json([
            'result' => 'true',
            'message' => 'Done!',
            'categories' => Category::where('name', 'like', '%'.$name.'%')->get()
        ]);
    }

    public function products ($id)
    {
        return response()->json([
            'result' => 'true',
            'message' => 'Done!',
            'products' => Category::find($id)->products->all()
        ]);
    }
}
