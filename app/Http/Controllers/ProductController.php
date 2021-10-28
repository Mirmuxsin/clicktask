<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
            'message' => 'Done',
            'products' => Product::all()
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
            'name' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'description' => 'required|string',
            'price' => 'required|integer'
        ]);

        if ( $request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/', $fileNameToStore);
        } else {
            return response()->json([
                'result' => false,
                'message' => 'Photo doesnt exists'
            ]);
        }

        $product = Product::create([
            'user_id' => auth()->user()['id'],
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'photo' => '/storage/'.$fileNameToStore,
        ]);

        return response()->json([
            'result' => 'true',
            'message' => 'Created successfully!',
            'product' => $product
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
            'message' => 'Done',
            'product' => Product::find($id)
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
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json([
            'result' => 'true',
            'message' => 'Updated!',
            'product' => $product
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
        Product::destroy($id);
        return response()->json([
            'result' => 'true',
            'message' => 'Deleted!',
        ]);
    }

     /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\JsonResponse
      */
    public function search($name)
    {
        return response()->json([
            'result' => 'true',
            'message' => 'Done!',
            'products' => Product::where('name', 'like', '%'.$name.'%')->get()
        ]);
    }

    public function category ($id)
    {
        return Product::find($id)->category;
    }
}
