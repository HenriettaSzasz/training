<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Categories;
use App\Products;

class CartController extends Controller
{
    protected $cart;

    public function __construct(){
        $this->cart = new Cart();
        $this->cart->create();
    }

    public function products(){
        $products = Products::all();

        $categories = Categories::all();

        $data = Cart::getCart();

        return response()->view('customer\products', ['products' => $products, 'categories' => $categories, 'cart' => $data]);
    }

    public function showProduct(int $id){
        $product = Products::find($id);

        $data = Cart::getCart();

        return response()->view('customer\details', ['product' => $product, 'cart' => $data]);
    }

    public function category(int $id){
        $products = Products::where('category_id', $id)->get();

        $categories = Categories::all();

        return response()->view('customer\products', ['products' => $products, 'categories' => $categories]);
    }

    public function cart()
    {
        $data = Cart::getCart();

        return view('customer\cart')->with(['products' => $data['products'], 'total' => $data['total']]);
    }

    public function addToCart($id)
    {
        $this->cart->add($id);

        return json_encode(Cart::getCart());
    }
    public function subtractFromCart($id){
        $this->cart->sub($id);

        return json_encode(Cart::getCart());
    }

    public function removeFromCart($id){
        $this->cart->remove($id);

        return json_encode(Cart::getCart());
    }

    public function updateCart($id, $quantity){
        $this->cart->add($id, $quantity);

        return json_encode(Cart::getCart());
    }
}
