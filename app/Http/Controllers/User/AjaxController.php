<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function pizzaList(Request $request){
        logger($request->all());
        if($request->status=='desc'){
            $data=Product::orderBy('created_at','desc')->get();


        }else{
            $data=Product::orderBy('created_at','asc')->get();

        }
               return response()->json($data,200);

    }
    // Add to cart

    public function addToCart(Request $request){
           $data= $this->getOrderData($request);
          Cart::create($data);
          $response= [
            'status'=>'success',
            'message'=>'Added to cart competely'
          ];
          
          return response()->json($response,200);
    }
    // 
    public function getOrderData($request){
            return [
                'product_id'=>$request->pizzaId,
                'user_id'=>$request->userId,
                'qty'=>$request->count,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()

            ];
            
    }
    // 
    public function order(Request $request){
        $total=0; 
        foreach($request->all() as $item){
           $data= OrderList::create([
                'user_id'=>$item['user_id'],
                'product_id'=>$item['product_id'],
                'qty'=>$item['qty'],
                'total'=>$item['total'],
                'order_code'=>$item['order_code'],
            ]);
            $total+=$data->total;    
        }
        Cart::where('user_id',Auth::user()->id)->delete(); 
        
        Order::create([
            'user_id'=>Auth::user()->id, 
            'order_code'=>$data->order_code,
            'total_price'=>$total+3000
        ]);
       
        return response()->json([
            'status'=>'true',
            'message'=>'Order Completed'
        ]);
        
    }
    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    // clear Current Product
    public function clearCurrentProduct(Request $request){
        
        
        Cart::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->where('id',$request->orderId)->delete();
     
        return response()->json(['status'=>'success'],200);
        
    }
    // view add
    public function increaseViewCount(Request $request){
        $pizza=Product::where('id',$request->productId)->first();
        $data=[
            'view_count'=>$pizza->view_count+1
        ];
        Product::where('id',$request->productId)->update($data);
    }
}
