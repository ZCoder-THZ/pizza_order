<?php

namespace App\Http\Controllers\User;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function home(){
        $pizzas=Product::orderBy('created_at','desc')->get();
        $categories=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','history'));

    }
    // change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    // change paswd
    public function changePassword(Request $request){
        $this->passwordValidaionCheck($request);


        $id=Auth::user()->id; //currentuserid
       $user=User::select('password')->where('id',$id)->first();

        // $oldPassword=Hash::make($request->oldPassword); password hashing
          $dbHashedValue=$user->password;//hash value

       if(Hash::check($request->oldPassword,$dbHashedValue)){ //Hash::check('plaintext',hashedValue)
            // dd('password match');
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id',$id)->update($data);
            // Auth::logout();
            return back()->with(['changeSuccess'=>'Password Changed Successfully']);
       }
    //    if failed
       return back()->with(['notMatch'=>'Password does not match .Invalid Credential ']);
    }
     // password validation check
     public function passwordValidaionCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:12',
            'newPassword'=>'required|min:6|max:12',
            'confirmPassword'=>'required|min:6|max:12|same:newPassword',
        ])->validate();
    }
    //
    public function accountChangePage(){
        return view('user.profile.account');

    }
    // account change
    public function accountChange(Request $request,$id){
        $this->accountValidationCheck($request);
        $data= $this->getUserData($request);
         // image
         if($request->hasFile('image')){
             // check old name | check=>delete |store
             $dbImage=User::where('id',$id)->first()->image;
             $fileName = uniqid() . $request->file('image')->getClientOriginalName();
             // delete IF the image name exists
             if($dbImage!==null){
                 Storage::delete('public/' . $dbImage); //deletting the image name from db
             }
             $request->file('image')->storeAs('public', $fileName);
             $data['image'] = $fileName;
         }

         User::where('id',$id)->update($data);
         return redirect()->route('user#accountChangePage')->with(['updateSuccess'=>'update successfully']);
    }
     // getUserdata
     public function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
        ];
    }
    //
    public function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
            'address'=>'required',
        ])->validate();
    }
    //
    public function filter($categoryId){
        $pizzas=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        // dd($history);
        return view('user.main.home',compact('pizzas','categories','cart','history'));
    }
    //
    public function pizzaDetails($id){
        $pizza=Product::where('id',$id)->first();
        $pizzaList=Product::get();

        return view('user.main.details',compact('pizza','pizzaList'));

    }
    //
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)
                    ->get();

        $totalPrice=0;

        foreach($cartList as $cartItem){
            $totalPrice+=$cartItem->pizza_price*$cartItem->qty;

        };

        return view('user.main.cart',compact('cartList','totalPrice'));

    }
    //
    public function history(){
        $orders=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);

        return view('user.main.history',compact('orders'));
    }
    //
    public function userList(){
        $users=User::where('role','user')->paginate(5);

        return view('admin.user.list',compact('users'));

    }
    //
    public function changeRole(Request $request){
        // logger($request->all());
        User::where('id',$request->userId)->update([
            'role'=>$request->role
        ]);

    }
    // customer contact
    public function contactPage(){
        return view('user.contact.contact');
    }
    // sent Message
    public function sendMessage(Request $request){
            Contact::create([
                'name'=>$request->userName,
                'email'=>$request->userEmail,
                'message'=>$request->message,
            ]);
            return redirect()->route('user#contactPage')->with(['messageSuccess'=>'Contact Succesfully']);
    }
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        Order::where('user_id',$id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess'=>'Deleted SuccessFully']);
    }
}
