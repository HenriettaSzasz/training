<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Http\Requests\StoreOrUpdateOrder;
use App\Orders;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class OrdersController extends Controller
{
    /**
     * The orders repository instance.
     */
    protected $orders;

    /**
     * Create a new controller instance.
     *
     * @param orders $orders
     */
    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::where('isAdmin', 0)->get();

        $array = array();

        foreach ($users as $user) {
            $array[$user['id']] = $user['name'];
        }

        return response()
            ->view('orders.create', ['users' => $array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrUpdateOrder $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateOrder $request)
    {
        $order = new Orders;
        $order->details = $request->input('details');
        $order->user_id = $request->user_id;
        $order->save();

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orders->find($id);

        return response()
            ->view('orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Orders $orders
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orders->find($id);

        $users = User::where([['id', '!=', $order->user_id], ['isAdmin', '=', 0]])->get();

        $array = array();

        $array[$order->user->id] = $order->user->name;

        foreach ($users as $user) {
            $array[$user['id']] = $user['name'];
        }

        return response()
            ->view('orders.edit', ['order' => $order, 'users' => $array]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrUpdateOrder $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(StoreOrUpdateOrder $request, $id)
    {
        $order = $this->orders->find($id);
        $order->details = $request->input('details');
        $order->user_id = $request->user_id;
        $order->save();

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $orders = $this->orders->find($id);

        $orders->delete();

        return redirect()->route('orders.index');
    }
}
