<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems;

class AdminController extends Controller
{
    public function index(){
        if(session()->get('type')=="admin"){
            return view('admin.index');
        }
        else{
            return redirect()->back();
        }
    }
    public function adminProfile(){
        if(session()->get('type')=="admin"){
            $user = User::find(session()->get('id'));
            return view('admin.profile',compact('user'));
        }
        else{
            return redirect()->back();
        }
    }
    public function products(){
        if(session()->get('type')=="admin"){
            $products = Product::all();
            return view('admin.products',compact('products'));
        }
        else{
            return redirect()->back();
        }  
    }
    public function ourCustomer(){
        if(session()->get('type')=="admin"){
            $customers = User::where('type','Customer')->get();
            return view('admin.customers',compact('customers'));
        }
        else{
            return redirect()->back();
        }  
    }
    public function orders(){
        if(session()->get('type')=="admin"){
            $orderItems = DB::table('order_items')
                    ->join('products','order_items.productId','products.id')
                    ->select('products.title','products.picture','order_items.*')
                    ->get();
            $order = DB::table('users')
                    ->join('orders','orders.customerId','users.id')
                    ->select('orders.*','users.fullname','users.email','users.status as userStatus')
                    ->get();
            return view('admin.order',compact('order','orderItems'));
        }
        else{
            return redirect()->back();
        }  
    }
    public function deleteproduct($id){
        if(session()->get('type')=="admin"){
            $products = Product::find($id)->delete();
            return redirect()->back()->with("success","congratulations !!! Product Delted Successfuly");
        }
        else{
            return redirect()->back();
        }
    }
    public function changeUserStatus($status , $id){
        if(session()->get('type')=="admin"){
            $user = User::find($id);
            $user->status = $status;
            $user->save();
            return redirect()->back()->with("success","congratulations !!! user Status Successfuly");
        }
        else{
            return redirect()->back();
        }
    }
    public function changeOrderStatus($status , $id){
        if(session()->get('type')=="admin"){
            $order = Order::find($id);
            $order->status = $status;
            $order->save();
            return redirect()->back()->with("success","congratulations !!! Order Status Successfuly");
        }
        else{
            return redirect()->back();
        }
    }
    public function addNewProduct(Request $req){
        if(session()->get('type')=="admin"){
            $products = new Product();
            $products->title = $req->input('title');
            $products->price = $req->input('price');
            $products->quantity = $req->input('quantity');
            $products->picture = $req->file('file')->getClientOriginalName();
            $req->file('file')->move('uploads/profiles/',$products->picture );
            $products->description = $req->input('description');
            $products->category = $req->input('category');
            $products->type = $req->input('type');
            $products->save();
            return redirect()->back()->with("success","congratulations !!! New Product Listed Successfuly");
        }
        else{
            return redirect()->back();
        }
        
    }
    public function updateProduct(Request $req){
        if(session()->get('type')=="admin"){
            $products = Product::find($req->input('id'));
            $products->title = $req->input('title');
            $products->price = $req->input('price');
            $products->quantity = $req->input('quantity');
            if($req->file('file')!=null){
                $products->picture = $req->file('file')->getClientOriginalName();
                $req->file('file')->move('uploads/profiles/',$products->picture );
            }
            $products->description = $req->input('description');
            $products->category = $req->input('category');
            $products->type = $req->input('type');
            $products->save();
            return redirect()->back()->with("success","congratulations !!! Product Updated Successfuly");
        }
        else{
            return redirect()->back();
        }
        
    }
}
