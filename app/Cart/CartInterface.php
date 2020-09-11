<?php


namespace App\Cart;


interface CartInterface
{
    function add($id);
    function remove($id);
    function sub($id);
    function new($id);
    static function getCart();
    function create();
}