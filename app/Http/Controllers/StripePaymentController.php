<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Product;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $req)
    {
        $bill = $req->input('bill');
        $fullname = $req->input('fullname');
        $phone = $req->input('phone');
        $address = $req->input('address');
        return view('stripe',compact('bill','fullname','phone','address'));
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey('sk_test_51OptsLK3URRIlCuOWUhXoMV60OGJtGOrqWJGn6nxfVTBXX0W6FVOZabO4jI8XZaQFYO0UXhlOCRd8DWdoTgGEO8V00aSsL7A3X');
    
        Stripe\Charge::create ([
                "amount" => $request->input('bill') * 100,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "New Order Payment Recieved Successfuly" 
        ]);
      
        Session::flash('success', 'Payment successful!');
        if(session()->has('id')){
            $order = new Order();
            $order->status = "Paid";
            $order->customerId = session()->get('id');
            $order->bill = $request->input('bill');
            $order->fullname = $request->input('fullname');
            $order->address = $request->input('address');
            $order->phone = $request->input('phone');
            if($order->save()){
                $cart = Cart::where('customerId',session()->get('id'))->get();
                foreach($cart as $item){
                    $product = Product::find($item->productId);
                    $orderItem = new OrderItem();
                    $orderItem->productId = $item->productId;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $product->price;
                    $orderItem->orderId = $order->id;
                    $orderItem->save();
                    $item->delete();
                }
            }
            return redirect('/cart');
        }
        else{
            return redirect('login');
        }
              
        return back();
    }
}
