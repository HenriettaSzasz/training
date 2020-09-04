<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::all();

        return response()
            ->view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('isAdmin', 0)->get();

        $array = array();

        foreach ($users as $user){
            $array[$user['id']] = $user['name'];
        }

        return response()
            ->view('orders.create', ['users' => $array]);
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
            'details'        => 'required',
            'user_id'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        } else {
            // store
            $order = new Orders;
            $order->details          = $request->input('details');
            $order->user_id         = $request->user_id;
            $order->save();

            return redirect()->route('orders.index');
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
        $order = Orders::find($id);

        return response()
            ->view('orders.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Orders::find($id);

        $users = User::where([['id', '!=', $order->user_id],['isAdmin', '=', 0]])->get();

        $array = array();

        $array[$order->user->id] = $order->user->name;

        foreach ($users as $user){
            $array[$user['id']] = $user['name'];
        }

        return response()
            ->view('orders.edit', ['order' => $order, 'users' => $array]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'details'        => 'required',
            'user_id'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        } else {
            // store
            $order = Orders::find($id);
            $order->details          = $request->input('details');
            $order->user_id         = $request->user_id;
            $order->save();

            return redirect()->route('orders.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $orders = Orders::find($id);

        $orders->delete();

        return redirect()->route('orders.index');
    }
}
