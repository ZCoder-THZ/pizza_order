<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function orderList(){
        $orders=Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')->orderBy('created_at','desc')
                ->paginate(5);
             
        return view('admin.order.list',compact('orders'));
    }
    // sort with ajax
    public function changeStatus(Request $request){
        
        $orders=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');
        if($request->orderStatus==null){
            $orders=$orders->get();
        }else{
            $orders=$orders->where('orders.status',$request->orderStatus)->get();
        }

        return view('admin.order.list',compact('orders'));

    }
    // 
   
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
      

    }
    // 
    public function listInfo($orderCode){
        $orderList=OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                  ->where('order_code',$orderCode)->get();
            // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList'));
    }
}
