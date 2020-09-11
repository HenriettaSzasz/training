<?php

namespace App\Http\Controllers;

use App\categories;
use App\DataTables\CategoriesDataTable;
use App\Http\Requests\StoreOrUpdateCategory;
use App\Orders;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * The categories repository instance.
     */
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @param categories $categories
     */
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable
            ->render('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()
            ->view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrUpdateCategory $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateCategory $request)
    {
        $category = new Categories;
        $category->name = $request->input('name');
        $category->briefing = $request->input('briefing');

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categories->find($id);

        return response()
            ->view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categories->find($id);

        return response()
            ->view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrUpdateCategory $request
     * @param $id
     * @return RedirectResponse|Response
     */
    public function update(StoreOrUpdateCategory $request, $id)
    {
        $category = $this->categories->find($id);
        $category->name = $request->input('name');
        $category->briefing = $request->input('briefing');
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $categories = $this->categories->find($id);

        $categories->delete();

        return redirect()->route('categories.index');
    }
}
