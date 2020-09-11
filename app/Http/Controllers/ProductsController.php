<?php

namespace App\Http\Controllers;

use App\Categories;
use App\DataTables\ProductsDataTable;
use App\Http\Requests\StoreOrUpdateProduct;
use App\products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * The products repository instance.
     */
    protected $products;
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @param products $products
     * @param Categories $categories
     */
    public function __construct(Products $products, Categories $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ProductsDataTable $dataTable
     * @return Response
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categories->all();
        $array = array();

        foreach ($categories as $category) {
            $array[$category['id']] = $category['name'];
        }

        return response()
            ->view('products.create', ['categories' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrUpdateProduct $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateProduct $request)
    {
        $product = new Products;
        $product->name = $request->input('name');
        $product->units = $request->input('units');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->products->where('id', $id)->first();

        $category = $this->categories->where('id', $product->category_id)->first();

        return response()
            ->view('products.show', ['product' => $product, 'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->products->where('id', $id)->first();

        $categories = $this->categories->where('id', '!=', $product->category_id)->get();

        $array = array();

        $array[$product->category->id] =$product->category->name;

        foreach ($categories as $category) {
            $array[$category['id']] = $category['name'];
        }

        return response()
            ->view('products.edit', ['product' => $product, 'categories' => $array]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrUpdateProduct $request
     * @param int $id
     * @return Response
     */
    public function update(StoreOrUpdateProduct $request, $id)
    {
        $product = $this->products->find($id);
        $product->name = $request->name;
        $product->units = $request->units;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->view('products.show', ['product' => $product, 'category' => $this->categories->find($product->category_id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->products->find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
