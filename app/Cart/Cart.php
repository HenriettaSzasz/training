<?php

namespace App\Cart;

use App\Products;

include 'CartInterface.php';


class Cart implements CartInterface
{

    function create()
    {
        if(!session()->exists('cart')){
            session()->put('cart', array());
        }
    }

    function add($id, $quantity = 1)
    {
        $updated = 0;
        foreach(session()->get('cart') as $key => $value){
            if ($value['id'] == $id) {
                $cart = session()->pull('cart');
                $cart[$key]['quantity'] = $cart[$key]['quantity'] + $quantity;
                $quantity = $cart[$key]['quantity'];
                session()->put('cart', $cart);
                $updated = 1;
                break;
            }
        }
        if($updated == 0){
            $this->new($id, $quantity);
        }
        return $quantity;
    }

    function remove($id)
    {
        foreach(session()->get('cart') as $key => $value){
            if ($value['id'] == $id) {
                $cart = session()->pull('cart');
                array_splice($cart, $key, 1);
                session()->put('cart', $cart);
            }
        }
    }

    function sub($id)
    {
        $quantity = 0;
        foreach(session()->get('cart') as $key => $value){
            if ($value['id'] == $id) {
                $cart = session()->pull('cart');
                $cart[$key]['quantity'] = $cart[$key]['quantity'] - 1;
                if($cart[$key]['quantity'] == 0){
                    array_splice($cart, $key, 1);
                }
                else{
                    $quantity = $cart[$key]['quantity'];
                }
                session()->put('cart', $cart);
            }
        }
        return $quantity;
    }

    function new($id, $quantity = 1){
        $product = Products::find($id);
        $cart = session()->pull('cart');
        array_unshift($cart, ['id' => $id, 'quantity' => $quantity, 'price' => $product->price, 'description'=> $product->description]);
        session()->put('cart', $cart);
    }

    static function removeCart(){
        session()->forget('cart');
    }

    static function isEmpty(){
        return !session()->has('cart');
    }

    static function getCart(){
        $data = ['products' => array(), 'total' => 0];

        if(session()->has('cart') && count(session()->get('cart')) > 0){

            $products = Products::all();
            $cart = session()->get('cart');

            $sum = 0;

            foreach ($cart as $key => $item){
                foreach ($products as $product){

                    if($product->id == $item['id']){
                        $add = array('id' => $product->id,'name' => $product->name, 'quantity' => $item['quantity'], 'price' => $product->price * $item['quantity']);
                        $sum += $product->price * $item['quantity'];
                    }
                }

                if(isset($add)){
                    array_push($data['products'], $add);
                    $data['total'] = $sum;
                }
            }
        }
        return $data;
    }
}
