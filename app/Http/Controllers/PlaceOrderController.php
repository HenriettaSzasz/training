<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Mail\OrderMail;
use App\OrderItems;
use App\Orders;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PlaceOrderController extends Controller
{
    public function placeOrder(Request $request){
        if(Cart::isEmpty()){
            return redirect()->route('cart');
        }

        $cart = Cart::getCart();

        $order = new Orders;
        $order->details = 'some details';
        $order->user_id = Auth::user()->id;
        $order->total = $cart['total'];
        $order->save();

        foreach ($cart['products'] as $item){
            $order_items = new OrderItems;
            $order_items->orders_id = $order->id;
            $order_items->quantity = $item['quantity'];
            $order_items->products_id = $item['id'];
            $order_items->save();
        }

        Cart::removeCart();

        $pdf = PDF::loadView('customer\pdf', ['order' => $order]);

        Mail::to(Auth::user())->send(new OrderMail($pdf, $order));

        if($request->paymentMethod === 'cash'){
            return redirect()->route('products');
        }

        return redirect()->route('payment', ['id' => $order->id]);
    }

    public function orderHistory(){
        $orders = Auth::user()->orders;

        return response()->view('customer\order-history', ['orders' => $orders]);
    }

    public function orderDetails($id){
        $order = Orders::find($id);

        return response()->view('customer\order-details', ['order' => $order]);
    }

    public function createPDF($id) {
        $data = Orders::find($id);

        view()->share('order',$data);
        $pdf = PDF::loadView('customer\pdf', $data);

        return $pdf->download('order_no' . $id . '.pdf');
    }

    public function payment($id){
        Stripe::setApiKey('sk_test_51HRCQqCXwYAEODPJc9gqwh0gPjpeOpVKoEpUgaIO4SAmSuPvyhGaFxLgO6GYWtLJONxJAhd0mHV70QqfXZHMJNwj00qg1zDEB5');

        $order = Orders::find($id);

        $intent = PaymentIntent::create([
            'amount' => $order->total,
            'currency' => 'eur',
        ]);

        return response()->view('customer\payment', ['intent' => $intent, 'id' => $id]);
    }

    public function confirmPayment($id){
        $order = Orders::find($id);

        $order->paid = true;
        $order->save();

        return redirect()->route('products');
    }
}
