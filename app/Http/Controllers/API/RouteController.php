<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //
    public function productList(){
        $product=Product::get();
        $data=[
            'product'=>$product
        ];
        return response()->json($data,200);
    }
    public function categoryList(){
        $category=Category::get();
        $data=[
            'category'=>$category
        ];
        return response()->json($data,200);
    }
    // id
    public function categoryListById($id){
        $category=Category::where('id',$id)->get();
        
        $data=[
            'category'=>$category
        ];
        return response()->json($data,200);
    }
    public function userList(){
        $user=User::get();
        $data=[
            'user'=>$user
        ];
        return response()->json($data,200);
    }
    public function cartList(){
        $cart=Cart::get();
        $data=[
            'cart'=>$cart
        ];
        return response()->json($data,200);
    }
    public function orderList(){
        $order=Order::get();
        $data=[
            'order'=>$order
        ];
        return response()->json($data,200);
    }
    public function ordersList(){
        $orders=OrderList::get();
        $data=[
            'order'=>$orders
        ];
        return response()->json($data,200);
    }
    public function contactList(){
        $contact=Contact::get();
        $data=[
            'contact'=>$contact
        ];
        return response()->json($data,200);
    }
    public function createContact(Request $request){
        $data=[
            "name"=>$request->name,
            "email"=>$request->email,
            "message"=>$request->message
        ];
        $response=Contact::create($data);
        return response()->json($data,200);
    }
    // delete by post method
    // public function deleteCategory(Request $request){
    //     $id=$request->id;
    //     $data=Category::where('id',$id)->first();
    //     if(isset($data)){
    //         $detete=Category::where('id',$id)->delete();
    //         return response()->json(['message'=>"successfully deleted",'deleted data'=>$detete],200);
    //     }
    //     return response()->json(['message'=>"doesn't exist",$id],404);
        
    // }
    // delete by get method
    public function deleteCategory($id){
       
        $data=Category::where('id',$id)->first();
        if(isset($data)){
            $delete=Category::where('id',$id)->delete();
            return response()->json(['message'=>"successfully deleted",'deleted data'=>$data],200);
        }
        return response()->json(['message'=>"doesn't exist",$id],404);
        
    }
    // update category
    public function updateCategory(Request $request){
       
        $data=Category::where('id',$request->id)->first();
        $categoryData=[
            "name"=>$request->name,
            "created_at"=>Carbon::now(),
            "updated_at"=>Carbon::now()
        ];
        if(isset($data)){
            $updateData=Category::where('id',$request->id)->update($categoryData);
            return response()->json(['message'=>"successfully updated",'updated data'=>$data],200);
        }
        return response()->json(['message'=>"doesn't exist"],404);
        
    }
}
