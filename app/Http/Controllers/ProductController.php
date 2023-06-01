<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
// use Illuminate\Support\Facades\Storage;
use Storage;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    //
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(5);
        // dd($pizzas->toArray());
        $pizzas->appends(request()->all);
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //
    public function createPage(){
        $categories = Category::select('name', 'id')->get();

        return view('admin.product.create',compact('categories'));
    }
    // create pizza
    public function create (Request $request){
        $this->productValidationCheck($request);
       $data=$this->requestProductInfo($request);

            $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image']=$fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }


    // delete
    public function delete(Request $request,$id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Product Successfully deleted']);
    }
    // edit page
    public function edit(Request $request,$id){
        $pizza=Product::select('products.*','categories.name as category_name')->where('products.id',$id)->leftJoin('categories','products.category_id','categories.id')->first();

        return view('admin.product.edit',compact('pizza'));
    }
    // update page
    public function updatePage($id){
        $pizza=Product::where('id',$id)->first();
        $categories=Category::get();

        return view('admin.product.update',compact('pizza','categories'));
    }
    // update
    public function update(Request $request,$id){
        $this->productValidationCheck($request,'update',$id);
        $data=$this->requestProductInfo($request);
        // return view('admin.product.update',compact('pizza','categories'));
        if($request->hasFile('pizzaImage')){
            $oldImageName=Product::where('id',$id)->first();
            $oldImageName=$oldImageName->image;

            if($oldImageName !== null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$id)->update($data);
        return redirect()->route('product#list');
    }
    // product validation
    public function productValidationCheck($request,$action='create',$id=''){
        $validationRules=[
            'pizzaName'=>'required|min:5|unique:products,name,'.$id,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaWaitingTime'=>'required',
            // 'pizzaImage'=>'required|mimes:png,jpg,jpeg,webp',
            'pizzaPrice'=>'required',
        ];
        $validationRules['pizzaImage']=$action != 'update'? 'required|mimes:png,jpg,jpeg,webp':'mimes:png,jpg,jpeg,webp';
        // dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();

    }
    // product info
    public function requestProductInfo($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'waiting_time'=>$request->pizzaWaitingTime,
            'price'=>$request->pizzaPrice,
        ];
    }
}
