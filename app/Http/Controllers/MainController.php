<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Termwind\Components\Raw;
use Laravel\Socialite\Facades\Socialite;

class MainController extends Controller
{
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }
    public function index(){
        $allproducts = Product::all();
        $newArrival = Product::where('type','new-arrivals')->get();
        $hotsale = Product::where('type','sales')->get();
        return view('index',compact('allproducts','newArrival','hotsale'));
    }
    public function cart(){
        $cartItems = DB::table('products')
        ->join('carts','carts.productId','products.id')
        ->select('products.title','products.quantity as pQuantity','products.price','products.picture','carts.*')
        ->where('carts.customerId',session()->get('id'))
        ->get();
        return view('cart',compact('cartItems'));
    }
    public function checkout(Request $req){
        if(session()->has('id')){
            $order = new Order();
            $order->status = "pending";
            $order->customerId = session()->get('id');
            $order->bill = $req->input('bill');
            $order->fullname = $req->input('fullname');
            $order->address = $req->input('address');
            $order->phone = $req->input('phone');
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
            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }
    public function shop(){
        return view('shop');
    }
    public function singleProduct($id){
        $product = Product::find($id);
        return view('single',compact('product'));
    }
    public function register(){
        return view('register');
    }
    public function registerUser(Request $req){
        $newUser = new User();
        $newUser->fullname = $req->input('name');
        $newUser->email = $req->input('email');
        $newUser->password = $req->input('password');
        $newUser->picture = $req->file('file')->getClientOriginalName();
        $req->file('file')->move('uploads/profiles', $newUser->picture);
        $newUser->type = "Customer";
        if($newUser->save()){
            return redirect('login')->with('success','Congratulations! Your Account Is Ready');
        }
    }
    public function updateUser(Request $req){
        $User = User::find(session()->get('id'));
        $User->fullname = $req->input('name');
        $User->password = $req->input('password');
        if($req->file('file')!=null){
            $User->picture = $req->file('file')->getClientOriginalName();
            $req->file('file')->move('uploads/profiles', $User->picture);
        }
       
        if($User->save()){
            return redirect()->back()->with('success','Congratulation You updated !!!');
        }
    }
    public function login(){
        return view('login');
    }
    public function loginUser(Request $req){
        $user = User::where('email',$req->input('email'))
                    ->where('password',$req->input('password'))
                    ->first();
        if($user){

            if($user->status == "Blocked"){
                return redirect('login')->with('error','You Are Blocked');
            }

            // create session ke liye put funcion use hoga
            session()->put('id',$user->id);
            session()->put('type',$user->type);

            // for customer 
            if($user->type=='Customer'){
                return redirect('/');
            }
            // for Admin
            else if($user->type=='admin'){
                return redirect('/admin/dashboard');
            }
        }
        else{
            return redirect('login')->with('error','Your Email Password Incorrect');
        }
    }
    public function logout(){
        session()->forget('id');
        session()->forget('type');

        return redirect('login');
    }
    public function addToCart(Request $req){
        if(session()->has('id')){
        $item = new Cart();
        $item->quantity = $req->input('quantity');
        $item->productId = $req->input('id');
        $item->customerId = session()->get('id');
        $item->save();

        return redirect()->back()->with('success','Item Added Into Cart');
        }
        else{
        return redirect('login')->with('error','Info! Please Login First');
        }
    }
    public function deleteCartItem($id){
        $item = Cart::find($id)->delete();
        // return redirect()->back()->withErrors(['msg' => 'The Message']);
        if($item){
            return redirect()->back();
        }
    }
    public function updateCart(Request $req){
        if(session()->has('id')){
            $item = Cart::find($req->input('id'));
            $item->quantity = $req->input('quantity');
            $item->save();
            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }
    public function profile(){
        if(session()->has('id')){
            $user = user::find(session()->get('id'));

            return view('profile',compact('user'));
        }
       return view('login');
    }
    public function myOrders(){
        if(session()->has('id')){
            $order = Order::where('customerId',session()->get('id'))->get();
            $items = DB::table('products')
                    ->join('order_items','products.id','order_items.id')
                    ->select('products.title','products.picture','order_items.*')
                    ->get();
            return view('orders',compact('order','items'));
        }
       return view('login');
    }
}
