<?php

namespace App\Http\Controllers;

use App\Categories;
use App\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $array = array();

        foreach ($products as $product){
            $category = Categories::find($product->category_id);
            $array[$category->id] = $category->name;
        }

        return response()
            ->view('products.index', ['products' => $products, 'categories' => $array]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id', 'name')->get();
        $array = array();

        foreach ($categories as $category){
            $array[$category['id']] = $category['name'];
        }

        return response()
            ->view('products.create',['categories' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'name'        => 'required',
            'units'       => 'required',
            'price'       => 'required',
            'description' => 'required',
            'category_id' => 'required|numeric'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $product = new Products;
            $product->name          = $request->input('name');
            $product->units         = $request->input('units');
            $product->price         = $request->input('price');
            $product->description   = $request->input('description');
            $product->category_id   = $request->input('category_id');
            $product->save();

            return redirect()->route('products.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::where('id', $id)->first();

        $category = Categories::where('id', $product->category_id)->first();

        return response()
            ->view('products.show', ['product' => $product, 'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::where('id', $id)->first();

        $categories = Categories::where('id', '!=', $product->category_id)->get();

        $product_category = Categories::where('id', $product->category_id)->first();

        $array = array();

        $array[$product_category['id']] = $product_category['name'];

        foreach ($categories as $category){
            $array[$category['id']] = $category['name'];
        }

        return response()
            ->view('products.edit', ['product' => $product, 'categories' => $array]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'        => 'required',
            'units'       => 'required',
            'price'       => 'required',
            'description' => 'required',
            'category_id' => 'required|numeric'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $product = Products::find($id);
            $product->name          = $request->name;
            $product->units         = $request->units;
            $product->price         = $request->price;
            $product->description   = $request->description;
            $product->category_id   = $request->category_id;
            $product->save();

            return response()->view('products.show', ['product' => $product, 'category' => Categories::find($product->category_id)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
