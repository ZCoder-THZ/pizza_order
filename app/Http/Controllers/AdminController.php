<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // // change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    // change password
    public function changePassword(Request $request){
        // dd($request->all());
        // all password must be filled
        // old password must be same with dbpassword
        // password and confirm passowrd must be same


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
    // account details
    public function details(){
        return view('admin.account.details');
    }
    // update account
    public function update(Request $request,$id){
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'update successfully']);
    }
    // update the account info
    public function edit(){
        return view('admin.account.edit');
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
    // admin list
    public function list(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('phone','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%');
        })->where('role','admin')->paginate(3);

        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }
    // admin delete
    public function delete($id){
            User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account successfully Deleted']);
    }
    // Change role
    public function changeRole($id){
            
           $account=User::where('id',$id)->first();
         return view('admin.account.changeRole',compact('account'));
    }
    // updateRole without ajax
//     public function updateRole(Request $request,$id){
//        $data=$this->requestUserData($request);
//         $account=User::where('id',$id)->update($data);
//         return redirect()->route('admin#list')->with(['updateSuccess'=>'updated Successfully']);
//     //   return view('admin.account.changeRole',compact('account'));
//  }
    // requrest userdata
    public function requestUserData($request){
        return [
            'role'=>$request->role
        ];
    }
    // contacts
    public function contacts(){
        $contacts=Contact::orderBy('created_at','desc')->paginate(5);
   
        return view('admin.contact.contacts',compact('contacts'));
        
    }
    // update role
    public function updateRole(Request $request){
        User::where('id',$request->userId)->update([
            'role'=>$request->role
        ]);
        return response()->json(['status'=>'success'],200);
        
}
}
