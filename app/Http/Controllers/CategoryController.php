<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function list(){
        // When()->works when the key is exist
        // %.key.% check article by article
        $categories=Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->orderBy('id','desc')->paginate(5);

        $categories->appends(request()->all);
        return view('admin.category.list',compact('categories'));
    }
    public function createPage(){
        return view('admin.category.create');
    }

    //
    public function create(Request $request){
    // first validation step
    $this->categoryValidationCheck($request);
    //data to array
    $data=$this->requestCategoryData($request);
    // careate data
    Category::create($data);
    // return list page
    // ()->with() is storing session
    return redirect()->route('category#list')->with(['categorySuccess'=>'category created']);

    }

    //
    public function requestCategoryData($request){
        return [
            'name'=>$request->categoryName
        ];
    }
     // edit category page
     public function edit(Request $request,$id){
        // delete
      $category=Category::where('id',$id)->first();

        // return list page
        return view('admin.category.edit',compact('category'));
    }

    // update the category
    public function update(Request $request,$id){

        $this->categoryValidationCheck($request,$id);
        $data=$this->requestCategoryData($request);


        Category::where('id',$id)->update($data);

     return redirect()->route('category#list');


    }
    // delete the category
    public function delete(Request $request,$id){

        // delete
        Category::where('id',$id)->delete();
        // return list page
        return back()->with(['deleteSuccess'=>'successfully deleted']);
    }
    // validaton
    public function categoryValidationCheck($request,$id=''){
        Validator::make($request->all(),[
            'categoryName'=>'required|min:4|unique:categories,name,'.$id
        ])->validate();
    }
}
